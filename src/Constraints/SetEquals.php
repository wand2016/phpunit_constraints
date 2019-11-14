<?php

declare(strict_types=1);

namespace WandTa\Constraints;

use PHPUnit\Framework\Constraint\Constraint;

/**
 * 集合
 */
final class SetEquals extends Constraint
{
    /** @var array */
    private $expectedSet;

    /**
     * @param array $expectedSet
     * @throws \InvalidArgumentException when elements duplicates.
     */
    public function __construct(array $expectedSet)
    {
        if (!self::isSet($expectedSet)) {
            throw new \InvalidArgumentException('Set cannot have duplicated elements.');
        }
        $this->expectedSet = $expectedSet;
    }

    /**
     * returns true when given array is set.
     * @param array $maybeSet
     * @return bool
     */
    protected static function isSet(array $maybeSet): bool
    {
        $uniqued = array_unique($maybeSet);
        return count($maybeSet) === count($uniqued);
    }

    /**
     * {@inheritDoc}
     */
    protected function matches($other): bool
    {
        return $other == $this->expectedSet;
    }

    /**
     * {@inheritDoc}
     */
    protected function failureDescription($other): string
    {
        return 'set ' . \json_encode($other) . ' ' . $this->toString();
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'is equal to set ' . \json_encode($this->expectedSet);
    }
}
