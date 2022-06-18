<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\AST;

/**
 * @extends CompositeNode<MagicMatchNode>
 * @internal
 */
class MagicRuleNode extends CompositeNode
{
    public function __construct(
        public readonly string $type,
        public readonly int $priority,
    ) {
    }

    public function getMaxLength(): int
    {
        return max(array_map(fn($m) => $m->getMaxLength(), $this->children));
    }
}
