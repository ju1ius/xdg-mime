<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test\Compiler\Optimization;

use ju1ius\XdgMime\Compiler\Optimization\Glob\CombineExpensiveGlobs;
use ju1ius\XdgMime\Compiler\Optimization\RecursivePass;
use ju1ius\XdgMime\Parser\AST\GlobNode;
use ju1ius\XdgMime\Parser\AST\GlobRegExpNode;
use ju1ius\XdgMime\Parser\AST\MimeInfoNode;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class CombineExpensiveGlobsTest extends TestCase
{
    /**
     * @dataProvider processProvider
     */
    public function testProcess(array $globs, array $expected): void
    {
        $info = new MimeInfoNode();
        $info->globs = $globs;
        $result = (new RecursivePass(new CombineExpensiveGlobs()))->process($info);
        Assert::assertEquals($expected, $result->globs);
    }

    public function processProvider(): iterable
    {
        yield 'single glob is not optimized' => [
            [new GlobNode('foo/bar', 50, '*.txt')],
            [new GlobNode('foo/bar', 50, '*.txt')],
        ];
        yield 'two globs are optimized' => [
            [
                new GlobNode('a/a', 50, 'a'),
                new GlobNode('a/b', 50, 'b'),
            ],
            [
                new GlobRegExpNode('~(?n)\A((*:0)a|(*:1)b)\z~Si', [
                    new GlobNode('a/a', 50, 'a'),
                    new GlobNode('a/b', 50, 'b'),
                ]),
            ],
        ];
        yield 'case-sensitive globs' => [
            [
                new GlobNode('a/a', 50, 'a'),
                new GlobNode('a/b', 50, 'b', true),
            ],
            [
                new GlobRegExpNode('~(?n)\A((*:0)a|(*:1)(?-i:b))\z~Si', [
                    new GlobNode('a/a', 50, 'a'),
                    new GlobNode('a/b', 50, 'b', true),
                ]),
            ],
        ];
        yield 'invalid glob is not optimized' => [
            [
                new GlobNode('a/a', 50, '[-0--]'),
                new GlobNode('a/b', 50, 'b'),
                new GlobNode('a/c', 50, 'c'),
            ],
            [
                new GlobNode('a/a', 50, '[-0--]'),
                new GlobRegExpNode('~(?n)\A((*:0)b|(*:1)c)\z~Si', [
                    new GlobNode('a/b', 50, 'b'),
                    new GlobNode('a/c', 50, 'c'),
                ]),
            ],
        ];
        yield 'invalid glob is not optimized #2' => [
            [
                new GlobNode('a/a', 50, 'a'),
                new GlobNode('a/b', 50, '[-0--]'),
                new GlobNode('a/c', 50, 'c'),
            ],
            [
                new GlobNode('a/a', 50, 'a'),
                new GlobNode('a/b', 50, '[-0--]'),
                new GlobNode('a/c', 50, 'c'),
            ],
        ];
        yield 'invalid glob is not optimized #3' => [
            [
                new GlobNode('a/a', 50, 'a'),
                new GlobNode('a/b', 50, 'b'),
                new GlobNode('a/c', 50, '[-0--]'),
            ],
            [
                new GlobRegExpNode('~(?n)\A((*:0)a|(*:1)b)\z~Si', [
                    new GlobNode('a/a', 50, 'a'),
                    new GlobNode('a/b', 50, 'b'),
                ]),
                new GlobNode('a/c', 50, '[-0--]'),
            ],
        ];
    }
}
