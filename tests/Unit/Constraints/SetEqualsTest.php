<?php

declare(strict_types=1);

namespace Tests\Unit\Constraints;

use PHPUnit\Framework\TestCase;
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
is equal to set Array &0 (
    0 => 1
    1 => 2
    2 => 3
)
EOL;

        $this->assertSame($expected, $this->sut->toString());
    }

    public function testConstraintSetEquals_count_is_one(): void
    {
        $this->assertCount(1, $this->sut);
    }

    //     public function testConstraintIsNull(): void
    //     {
    //         $constraint = new IsNull;

    //         $this->assertFalse($constraint->evaluate(0, '', true));
    //         $this->assertTrue($constraint->evaluate(null, '', true));
    //         $this->assertEquals('is null', $constraint->toString());
    //         $this->assertCount(1, $constraint);

    //         try {
    //             $constraint->evaluate(0);
    //         } catch (ExpectationFailedException $e) {
    //             $this->assertEquals(
    //                 <<<EOF
    // Failed asserting that 0 is null.

    // EOF
    //                 ,
    //                 TestFailure::exceptionToString($e)
    //             );

    //             return;
    //         }

    //         $this->fail();
    //     }

    //     public function testConstraintIsNull2(): void
    //     {
    //         $constraint = new IsNull;

    //         try {
    //             $constraint->evaluate(0, 'custom message');
    //         } catch (ExpectationFailedException $e) {
    //             $this->assertEquals(
    //                 <<<EOF
    // custom message
    // Failed asserting that 0 is null.

    // EOF
    //                 ,
    //                 TestFailure::exceptionToString($e)
    //             );

    //             return;
    //         }

    //         $this->fail();
    //     }
}
