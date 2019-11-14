<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use WandTa\Constraints\SetEquals;

class AssertTest extends TestCase
{
    /**
     * @test
     */
    public function Constraint_SetEquals_works(): void
    {
        $this->assertSetEquals(
            [1, 2, 3],
            [3, 1, 2]
        );
    }

    protected function assertSetEquals(
        array $expectedSet,
        $set
    ): void {
        $this->assertThat(
            $set,
            new SetEquals($expectedSet)
        );
    }
}
