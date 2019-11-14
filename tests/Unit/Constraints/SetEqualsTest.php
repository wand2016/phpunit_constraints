<?php

declare(strict_types=1);

namespace Tests\Unit\Constraints;

use PHPUnit\Framework\TestCase;
use WandTa\Constraints\SetEquals;

class SetEqualsTest extends TestCase
{
    public function testConstraintSetEquals_equality(): void
    {
        $constraint = new SetEquals([1, 2, 3]);
        $this->assertTrue($constraint->evaluate([1, 2, 3], '', true));
    }

    public function testConstraintSetEquals_count_is_one(): void
    {
        $constraint = new SetEquals([1, 2, 3]);

        $this->assertCount(1, $constraint);
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
