<?php

declare(strict_types=1);

namespace WandTa\Constraints;

use PHPUnit\Framework\Constraint\Constraint;

/**
 * 集合
 */
class SetEquals extends Constraint
{
    /** @var array */
    private $expectedSet;

    /**
     * @param array $expectedSet
     * @throws \InvalidArgumentException when elements duplicates.
     */
    public function __construct(array $expectedSet)
    {
        $uniqued = array_unique($expectedSet);
        if (count($expectedSet) !== count($uniqued)) {
            throw new \InvalidArgumentException('Set cannot have duplicated elements.');
        }
        $this->expectedSet = $expectedSet;
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
