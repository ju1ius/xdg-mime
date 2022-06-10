<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

use ju1ius\XDGMime\Magic\AbstractRule;

final class MagicDatabase implements MagicDatabaseInterface
{
    /**
     * @param array<string, array{int, AbstractRule}[]> $rules
     * @param int $maxRuleLength
     */
    public function __construct(
        private readonly array $rules,
        private readonly int $maxRuleLength,
    ) {
    }

    /**
     * Read data from the file and do magic sniffing on it.
     *
     * `$maxPriority` & `$minPriority` can be used to specify the maximum & minimum priority rules to look for.
     *
     * `$possible` can be a list of mimetypes to check, or null (the default) to check all mimetypes until one matches.
     *
     * Returns the MIME type found, or null if no entries match.
     * Raises IOError if the file can't be opened.
     */
    public function match(string $path, ?array $allowedTypes = null): ?string
    {
        $fp = fopen($path, 'rb');
        $buffer = fread($fp, $this->maxRuleLength);
        fclose($fp);

        if ($buffer === false) {
            return null;
        }

        return $this->matchData($buffer, $allowedTypes);
    }

    public function matchData(string $data, ?array $allowedTypes = null): ?string
    {
        if ($allowedTypes) {
            $types = [];
            foreach ($allowedTypes as $type) {
                foreach ($this->rules[$type] as [$priority, $rule]) {
                    $types[] = [$priority, $type, $rule];
                }
            }
            usort($types, fn(array $a, array $b) => $a[0] - $b[0]);
        } else {
            $types = $this->rules;
        }

        $length = min(\strlen($data), $this->maxRuleLength);

        /**
         * @var int $priority
         * @var string $type
         * @var AbstractRule $rule
         */
        foreach ($types as [$priority, $type, $rule]) {
            if ($rule->matches($data, $length)) {
                return $type;
            }
        }

        return null;
    }
}