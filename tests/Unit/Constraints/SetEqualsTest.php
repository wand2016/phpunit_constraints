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

    public function testConstraintSetEquals_equality(): void
    {
        $this->assertTrue($this->sut->evaluate([1, 2, 3], '', true));
    }

    public function testConstraintSetEquals_inequality(): void
    {
        $this->assertFalse($this->sut->evaluate([0, 2, 3], '', true));
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
            $this->sut->evaluate([2,3,4]);
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                <<<EOF
Failed asserting that set [2,3,4] is equal to set [1,2,3].

EOF
                ,
                TestFailure::exceptionToString($e)
            );

            return;
        }

        $this->fail();
    }
}
