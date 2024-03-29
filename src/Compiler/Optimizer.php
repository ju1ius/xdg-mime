<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler;

use ju1ius\XdgMime\Compiler\Optimization\Glob\CombineExpensiveGlobs;
use ju1ius\XdgMime\Compiler\Optimization\Lookup\PopulateAliasLookup;
use ju1ius\XdgMime\Compiler\Optimization\Lookup\PopulateGlobLookup;
use ju1ius\XdgMime\Compiler\Optimization\Lookup\PopulateHierarchyLookup;
use ju1ius\XdgMime\Compiler\Optimization\Lookup\PopulateIconLookup;
use ju1ius\XdgMime\Compiler\Optimization\Lookup\PopulateMagicLookup;
use ju1ius\XdgMime\Compiler\Optimization\Lookup\PopulateTreeMagicLookup;
use ju1ius\XdgMime\Compiler\Optimization\Lookup\PopulateXmlNamespaceLookup;
use ju1ius\XdgMime\Compiler\Optimization\Magic\CombineAndMatches;
use ju1ius\XdgMime\Compiler\Optimization\Magic\CombineOrMatches;
use ju1ius\XdgMime\Compiler\Optimization\Magic\ConvertExpensiveMatch;
use ju1ius\XdgMime\Compiler\Optimization\Magic\ConvertToMachineByteOrder;
use ju1ius\XdgMime\Compiler\Optimization\Magic\RegExpManipulator;
use ju1ius\XdgMime\Compiler\Optimization\OptimizationPassInterface;
use ju1ius\XdgMime\Compiler\Optimization\RecursivePass;
use ju1ius\XdgMime\Parser\AST\MimeInfoNode;
use ju1ius\XdgMime\Utils\Bytes;

/**
 * @internal
 */
final class Optimizer
{
    /**
     * @var OptimizationPassInterface[]
     */
    private array $passes = [];

    public static function create(bool $optimize = true, bool $platformDependent = false): self
    {
        $optimizations = [
            new PopulateAliasLookup(),
            new PopulateHierarchyLookup(),
            new PopulateGlobLookup(),
            new PopulateMagicLookup(),
            new PopulateTreeMagicLookup(),
            new PopulateIconLookup(),
            new PopulateXmlNamespaceLookup(),
        ];

        if (!$optimize) {
            return (new self())->add(new RecursivePass(...$optimizations));
        }

        $manipulator = new RegExpManipulator('~');
        $optimizations = [
            new ConvertExpensiveMatch($manipulator),
            new CombineOrMatches($manipulator),
            new CombineAndMatches($manipulator),
            ...$optimizations,
            new CombineExpensiveGlobs(),
        ];

        if ($platformDependent) {
            $optimizations = [
                new ConvertToMachineByteOrder(Bytes::isLittleEndianPlatform()),
                ...$optimizations,
            ];
        }

        return (new self())->add(new RecursivePass(...$optimizations));
    }

    public function add(OptimizationPassInterface ...$passes): self
    {
        array_push($this->passes, ...$passes);

        return $this;
    }

    public function process(MimeInfoNode $info): MimeInfoNode
    {
        foreach ($this->passes as $pass) {
            $info = $pass->process($info);
        }

        return $info;
    }
}
