<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Magic;

use ju1ius\XdgMime\Compiler\Optimization\AbstractNodeVisitor;
use ju1ius\XdgMime\Parser\AST\MagicMatchNode;
use ju1ius\XdgMime\Parser\AST\MagicRegexNode;
use ju1ius\XdgMime\Parser\AST\Node;
use ju1ius\XdgMime\Utils\Iter;

/**
 * @internal
 */
final class CombineAndMatches extends AbstractNodeVisitor
{
    public function __construct(
        private readonly RegExpManipulator $manipulator,
    ) {
    }

    public function leaveNode(Node $node): Node
    {
        if ($node instanceof MagicMatchNode && $this->isEligibleNode($node)) {
            return $this->processMatch($node);
        }

        return $node;
    }

    public function processMatch(MagicMatchNode $match): MagicMatchNode
    {
        $ifPattern = $this->manipulator->patternFor($match);
        $thenPatterns = [];
        $maxLength = $match->getMaxLength();
        foreach ($match->children as $child) {
            $thenPatterns[] = $this->manipulator->patternFor($child);
            $maxLength = max($maxLength, $child->getMaxLength());
        }
        $thenPattern = $this->manipulator->or(...$thenPatterns);
        $pattern = $this->manipulator->and($ifPattern, $thenPattern);

        return new MagicRegexNode($pattern, $this->manipulator->finalize($pattern), $maxLength);
    }

    private function isEligibleNode(MagicMatchNode $node): bool
    {
        return (
            $this->manipulator->canCompile($node)
            && $node->children
            && Iter::every($node->children, $this->isEligibleChild(...))
        );
    }

    private function isEligibleChild(MagicMatchNode $node): bool
    {
        return $this->manipulator->canCompile($node);
    }
}
