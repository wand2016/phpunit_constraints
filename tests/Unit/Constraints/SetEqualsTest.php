<?php

declare(strict_types=1);

namespace Tests\Unit\Constraints;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestFailure;
use WandTa\Constraints\SetEquals;

class SetEqualsTest extends TestCase
{
    /** @var SetEquals $sut */
    private $sut;

    public function setUp(): void
    {
        parent::setUp();
        $this->sut = new SetEquals([1, 2, 3]);
    }

    /**
     * @expectedException
     */
    public function testConstraintSetEquals_construct_with_not_set(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $sut = new SetEquals([1, 1, 3]);
        $this->fail('element duplication');
    }

    public function testConstraintSetEquals_equality(): void
    {
        $this->assertTrue($this->sut->evaluate([1, 2, 3], '', true));
    }

    public function testConstraintSetEquals_equality_not_the_same_order(): void
    {
        $this->assertTrue($this->sut->evaluate([2, 3, 1], '', true));
    }

    public function testConstraintSetEquals_inequality(): void
    {
        $this->assertFalse($this->sut->evaluate([0, 2, 3], '', true));
    }

    public function testConstraintSetEquals_inequality_not_array(): void
    {
        $this->assertFalse($this->sut->evaluate(1, '', true));
    }

    public function testConstraintSetEquals_toString(): void
    {
        $expected = <<<EOL
is equal to set [1,2,3]
EOL;

        $this->assertSame($expected, $this->sut->toString());
    }

    /**
     * @test
     */
    public function testConstraintSetEquals_evaluateException(): void
    {
        try {
            $this->sut->evaluate([2, 3, 4]);
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                <<<EOF
Failed asserting that set [2,3,4] is equal to set [1,2,3].

EOF,
                TestFailure::exceptionToString($e)
            );

            return;
        }

        $this->fail();
    }
}
