<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization;

use ju1ius\XdgMime\Parser\AST\MimeInfoNode;

/**
 * @internal
 */
interface OptimizationPassInterface
{
    public function process(MimeInfoNode $info): MimeInfoNode;
}
