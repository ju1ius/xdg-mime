<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Parser\Validator;

use ju1ius\XdgMime\Parser\Exception\ParseError;
use ju1ius\XdgMime\Parser\MimeInfoValidatorInterface;

/**
 * @internal
 */
abstract class AbstractSchemaValidator implements MimeInfoValidatorInterface
{
    final public function validate(\DOMDocument $document): void
    {
        $useInternalErrors = libxml_use_internal_errors(true);
        libxml_clear_errors();
        $this->doValidate($document);
        $errors = libxml_get_errors();
        libxml_clear_errors();
        libxml_use_internal_errors($useInternalErrors);
        if ($err = $errors[0] ?? null) {
            throw ParseError::fromLibXml($err);
        }
    }

    abstract protected function doValidate(\DOMDocument $document): void;
}
