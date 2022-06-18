<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler;

use ju1ius\XdgMime\Compiler\Optimization\AliasLookupPass;
use ju1ius\XdgMime\Compiler\Optimization\GlobsLookupPass;
use ju1ius\XdgMime\Compiler\Optimization\HierarchyLookupPass;
use ju1ius\XdgMime\Compiler\Optimization\Magic\CombineAndMatches;
use ju1ius\XdgMime\Compiler\Optimization\Magic\CombineOrMatches;
use ju1ius\XdgMime\Compiler\Optimization\Magic\ConvertExpensiveMatch;
use ju1ius\XdgMime\Compiler\Optimization\Magic\RegExpManipulator;
use ju1ius\XdgMime\Compiler\Optimization\MagicLookupPass;
use ju1ius\XdgMime\Compiler\Optimization\MagicRulesOptimizationPass;
use ju1ius\XdgMime\Compiler\Optimization\OptimizationPassInterface;
use ju1ius\XdgMime\Compiler\Optimization\TreeMagicLookupPass;
use ju1ius\XdgMime\Parser\AST\MimeInfoNode;

final class Optimizer
{
    /**
     * @var OptimizationPassInterface[]
     */
    private array $passes = [];

    public static function create(): self
    {
        $manipulator = new RegExpManipulator();
        return (new self())
            ->add(
                new AliasLookupPass(),
                new HierarchyLookupPass(),
                new GlobsLookupPass(),
                new MagicLookupPass(),
                new TreeMagicLookupPass(),
                new MagicRulesOptimizationPass([
                    new ConvertExpensiveMatch($manipulator),
                    new CombineOrMatches($manipulator),
                    new CombineAndMatches($manipulator),
                ]),
            )
        ;
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
