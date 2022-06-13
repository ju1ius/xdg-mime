<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler;

use ju1ius\XDGMime\Parser\Node\GlobNode;
use ju1ius\XDGMime\Parser\Node\MagicNode;
use ju1ius\XDGMime\Parser\Node\MatchNode;
use ju1ius\XDGMime\Parser\Node\TypeNode;
use ju1ius\XDGMime\Runtime\AliasesDatabase;
use ju1ius\XDGMime\Runtime\Glob;
use ju1ius\XDGMime\Runtime\GlobLiteral;
use ju1ius\XDGMime\Runtime\GlobsDatabase;
use ju1ius\XDGMime\Runtime\MagicDatabase;
use ju1ius\XDGMime\Runtime\MagicMatch;
use ju1ius\XDGMime\Runtime\MagicRule;
use ju1ius\XDGMime\Runtime\MimeDatabase;
use ju1ius\XDGMime\Runtime\SubclassesDatabase;
use Symfony\Component\Filesystem\Filesystem;

final class MimeDatabaseCompiler
{
    private readonly Filesystem $fs;

    public function __construct()
    {
        $this->fs = new Filesystem();
    }

    /**
     * @param array<string, TypeNode> $types
     */
    public function compileToString(array $types): string
    {
        $lookup = $this->createLookup($types);

        $code = new CodeBuilder();

        $code->write('return ')->new(MimeDatabase::class)->raw("(\n");
        $code->indent();

        $code->write('');
        $this->compileAliases($lookup['aliases'], $code);
        $code->raw(",\n");

        $code->write('');
        $this->compileSubClasses($lookup['subclasses'], $code);
        $code->raw(",\n");

        $code->write('');
        $this->compileGlobs($lookup['globs'], $code);
        $code->raw(",\n");

        $code->write('');
        $this->compileMagicRules($lookup['magic'], $code);
        $code->raw(",\n");

        $code->dedent()->writeln(');');

        return (string)$code;
    }

    public function compileToFile(array $types, string $path): void
    {
        $code = CodeBuilder::forFile()
            ->raw($this->compileToString($types))
        ;
        $this->fs->dumpFile($path, $code);
    }

    public function compileToDirectory(array $types, string $path): void
    {
        $lookup = $this->createLookup($types);

        $code = CodeBuilder::forFile()->write('return ');
        $this->compileAliases($lookup['aliases'], $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/aliases.php", $code);

        $code = CodeBuilder::forFile()->write('return ');
        $this->compileSubClasses($lookup['subclasses'], $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/subclasses.php", $code);

        $code = CodeBuilder::forFile()->write('return ');
        $this->compileGlobs($lookup['globs'], $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/globs.php", $code);

        $code = CodeBuilder::forFile()->write('return ');
        $this->compileMagicRules($lookup['magic'], $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/magic.php", $code);

        // TODO: treemagic
        //$this->fs->dumpFile("{$path}/treemagic.php", "<?php\n");
    }

    /**
     * @param array<string, TypeNode> $types
     */
    private function createLookup(array $types): array
    {
        $aliases = [];
        $subclasses = [];
        $globs = [];
        $magicRules = [];
        foreach ($types as $canonical => $type) {
            if ($type->subclassOf) {
                $subclasses[$canonical] = $type->subclassOf;
            }
            foreach ($type->aliases as $alias) {
                $aliases[$alias] = $canonical;
            }
            foreach ($type->globs as $glob) {
                $globs[] = $glob;
            }
            foreach ($type->magic as $rule) {
                $magicRules[] = $rule;
            }
            // TODO: TreeMagic
        }

        return [
            'subclasses' => $subclasses,
            'aliases' => $aliases,
            'globs' => $this->createGlobLookup($globs),
            'magic' => $this->createMagicLookup($magicRules),
            'treemagic' => [],
        ];
    }

    private function compileSubClasses(array $lookup, CodeBuilder $code): void
    {
        $code->new(SubclassesDatabase::class)->raw("([\n");
        $code->indent();
        foreach ($lookup as $key => $value) {
            $code->write('')
                ->string($key)->raw(' => ')->repr($value)
                ->raw(",\n")
            ;
        }
        $code->dedent()->write('])');
    }

    private function compileAliases(array $lookup, CodeBuilder $code): void
    {
        $code->new(AliasesDatabase::class)->raw("([\n");
        $code->indent();
        foreach ($lookup as $key => $value) {
            $code->write('')
                ->string($key)
                ->raw(' => ')
                ->string($value)
                ->raw(",\n")
            ;
        }
        $code->dedent()->write('])');
    }

    private function compileGlobs(array $lookup, CodeBuilder $code): void
    {
        $code->new(GlobsDatabase::class)->raw("(\n");
        $code->indent();
        $literalKeys = [
            'extensions',
            'caseSensitiveExtensions',
            'literals',
            'caseSensitiveLiterals',
        ];
        foreach ($literalKeys as $lookupKey) {
            $hashMap = $lookup[$lookupKey];
            if (!$hashMap) {
                $code->writeln(sprintf('%s: [],', $lookupKey));
                continue;
            }
            $code->writeln(sprintf('%s: [', $lookupKey))->indent();
            /** @var GlobLiteral|GlobLiteral[] $value */
            foreach ($hashMap as $key => $value) {
                $code->write('')->string((string)$key)->raw(' => ');
                if (\is_array($value)) {
                    $code
                        ->raw('[')
                        ->join(', ', $value, fn($v) => $this->compileGlobLiteral($v, $code))
                        ->raw(']')
                    ;
                } else {
                    $this->compileGlobLiteral($value, $code);
                }
                $code->raw(",\n");
            }
            $code->dedent()->writeln('],');
        }
        $code->writeln('globs: [')->indent();
        /** @var Glob $glob */
        foreach ($lookup['globs'] as $glob) {
            $code->write('')->new(Glob::class)->raw('(')
                ->string($glob->type)->raw(', ')
                ->repr($glob->weight)->raw(', ')
                ->string($glob->pattern)->raw(', ')
                ->repr($glob->caseSensitive)
                ->raw("),\n")
            ;
        }
        $code->dedent()->writeln('],')->dedent()->write(')');
    }

    private function compileGlobLiteral(GlobLiteral $glob, CodeBuilder $code): void
    {
        $code->new(GlobLiteral::class)->raw('(')
            ->string($glob->type)->raw(', ')
            ->raw("{$glob->weight}, {$glob->length}")
            ->raw(')')
        ;
    }

    private function compileMagicRules(array $lookup, CodeBuilder $code): void
    {
        $code->new(MagicDatabase::class)->raw("(\n");
        $code->indent();
        $code->writeln(sprintf('lookupBufferSize: %d,', $lookup['lookupBufferSize']));

        $code->writeln('rules: [')->indent();
        /** @var MagicNode $rule */
        foreach ($lookup['rules'] as $rule) {
            $code
                ->write('')
                ->new(MagicRule::class)->raw('(')
                ->string($rule->type)->raw(', ')
                ->repr($rule->priority)->raw(', ')
                ->raw("[\n")
                ->indent()
            ;
            foreach ($rule->matches as $match) {
                $code->write('');
                $this->compileMagicMatch($match, $code);
                $code->raw(",\n");
            }
            $code->dedent()->writeln(']),');
        }
        $code->dedent()->writeln('],');
        $code->dedent()->write(')');
    }

    private function compileMagicMatch(MatchNode $match, CodeBuilder $code): void
    {
        $code
            ->new(MagicMatch::class)->raw('(')
            ->raw("{$match->start}, {$match->end}, ")
            ->string($match->value)->raw(', ')
            ->string($match->mask)->raw(', ')
            ->repr($match->wordSize)
        ;
        if ($match->and) {
            $code
                ->raw(', [')
                ->join(', ', $match->and, fn($and) => $this->compileMagicMatch($and, $code))
                ->raw(']')
            ;
        }
        $code->raw(')');
    }

    /**
     * @param GlobNode[] $globs
     */
    private function createGlobLookup(array $globs): array
    {
        $lookup = [
            'extensions' => [],
            'caseSensitiveExtensions' => [],
            'literals' => [],
            'caseSensitiveLiterals' => [],
            'globs' => [],
        ];
        foreach ($globs as $node) {
            if ($node->isLiteral && $node->isExtensionGlob) {
                $glob = new GlobLiteral($node->type, $node->weight, \strlen($node->pattern));
                if ($node->caseSensitive) {
                    $lookup['caseSensitiveExtensions'][$node->extension][] = $glob;
                } else {
                    $lookup['extensions'][strtolower($node->extension)][] = $glob;
                }
            } elseif ($node->isLiteral) {
                $glob = new GlobLiteral($node->type, $node->weight, \strlen($node->pattern));
                if ($node->caseSensitive) {
                    $lookup['caseSensitiveLiterals'][$node->pattern] = $glob;
                } else {
                    $lookup['literals'][strtolower($node->pattern)] = $glob;
                }
            } else {
                $lookup['globs'][] = new Glob($node->type, $node->weight, $node->pattern, $node->caseSensitive);
            }
        }

        $compareGlobs = self::compareGlobs(...);
        foreach (array_keys($lookup['caseSensitiveExtensions']) as $ext) {
            usort($lookup['caseSensitiveExtensions'][$ext], $compareGlobs);
        }
        foreach (array_keys($lookup['extensions']) as $ext) {
            usort($lookup['extensions'][$ext], $compareGlobs);
        }
        //uasort($lookup['case_sensitive_literals'], $compareGlobs);
        //uasort($lookup['literals'], $compareGlobs);
        usort($lookup['globs'], $compareGlobs);

        return $lookup;
    }

    private static function compareGlobs(GlobLiteral $a, GlobLiteral $b): int
    {
        return $b->weight <=> $a->weight ?: $b->length <=> $a->length;
    }

    /**
     * @param MagicNode[] $rules
     */
    private function createMagicLookup(array $rules): array
    {
        usort($rules, fn(MagicNode $a, MagicNode $b) => $b->priority <=> $a->priority ?: $a->type <=> $b->type);
        $lookupBufferSize = 0;
        foreach ($rules as $rule) {
            $lookupBufferSize = max($lookupBufferSize, $rule->getMaxLength());
        }
        return [
            'lookupBufferSize' => $lookupBufferSize,
            'rules' => $rules,
        ];
    }
}
