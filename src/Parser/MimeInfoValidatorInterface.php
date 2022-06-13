<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser;

use ju1ius\XDGMime\Parser\Exception\ParseError;

interface MimeInfoValidatorInterface
{
    /**
     * @throws ParseError when the document is invalid.
     */
    public function validate(\DOMDocument $document): void;
}