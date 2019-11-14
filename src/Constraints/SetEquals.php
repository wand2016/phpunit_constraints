<?php

declare(strict_types=1);

namespace WandTa\Constraints;

use PHPUnit\Framework\Constraint\Constraint;

/**
 * Given set is equal to an expected set.
 */
final class SetEquals extends Constraint
{
    /** @var array $expectedSet */
    private $expectedSet;

    /**
     * @param mixed $expectedSet
     * @throws \InvalidArgumentException when elements duplicate.
     */
    public function __construct($expectedSet)
    {
        if (!self::isSet($expectedSet)) {
            throw new \InvalidArgumentException('Set cannot have duplicated elements.');
        }
        $this->expectedSet = $expectedSet;
    }

    /**
     * returns true when given array is set.
     * @param mixed $maybeSet
     * @return bool
     */
    protected static function isSet($maybeSet): bool
    {
        if (!is_array($maybeSet)) {
            return false;
        }

        $uniqued = array_unique($maybeSet);
        return count($maybeSet) === count($uniqued);
    }

    /**
     * {@inheritDoc}
     */
    protected function matches($other): bool
    {
        if (!self::isSet($other)) {
            return false;
        }

        return self::sorted($this->expectedSet)
            == self::sorted($other);
    }

    /**
     * get sorted array from given set.
     * @param array $set
     * @return array sorted array
     */
    protected static function sorted(array $set): array
    {
        sort($set);
        return array_values($set);
    }

    /**
     * {@inheritDoc}
     */
    protected function failureDescription($other): string
    {
        return (self::isSet($other) ? 'set ' : '')
            . \json_encode($other) . ' ' . $this->toString();
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'is equal to set ' . \json_encode($this->expectedSet);
    }
}
