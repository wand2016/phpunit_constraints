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
     * @todo 重複チェック
     */
    public function __construct(array $expectedSet)
    {
        $this->expectedSet = $expectedSet;
    }

    /**
     * Evaluates the constraint for parameter $other. Returns true if the
     * constraint is met, false otherwise.
     *
     * This method can be overridden to implement the evaluation algorithm.
     *
     * @param mixed $other value or object to evaluate
     * @codeCoverageIgnore
     */
    protected function matches($other): bool
    {
        return $other == $this->expectedSet;
    }

    /**
     * Returns a string representation of the constraint.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function toString(): string
    {
        return 'is equal to set ' . $this->exporter()->export($this->expectedSet);
    }
}
