<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Parser\AST;

/**
 * @extends CompositeNode<TreeMatchNode>
 * @internal
 */
final class TreeMatchNode extends CompositeNode
{
    public function __construct(
        public string $path,
        public int $flags,
        public ?string $mimeType = null,
    ) {
    }
}
