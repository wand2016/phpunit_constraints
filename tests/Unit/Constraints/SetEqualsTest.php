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
     * @test
     */
    public function construct_failes_with_not_a_set(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $sut = new SetEquals([1, 1, 3]);
        $this->fail('element duplication');
    }

    /**
     * @test
     * @dataProvider dataProvider_passes
     */
    public function passes($spec): void
    {
        $this->assertTrue($this->sut->evaluate($spec, '', true));
    }

    /**
     * @test
     * @dataProvider dataProvider_given_and_message
     */
    public function failes($spec): void
    {
        $this->assertFalse($this->sut->evaluate($spec, '', true));
    }


    /**
     * @test
     */
    public function toString_expected_format(): void
    {
        $expected = <<<EOL
is equal to set [1,2,3]
EOL;

        $this->assertSame($expected, $this->sut->toString());
    }

    /**
     * @test
     * @dataProvider dataProvider_given_and_message
     */
    public function evaluateException_message(
        $other,
        string $expectedMessage
    ): void {
        try {
            $this->sut->evaluate($other);
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                $expectedMessage,
                TestFailure::exceptionToString($e)
            );

            return;
        }

        $this->fail();
    }

    // ----------------------------------------
    // dataProviders
    // ----------------------------------------

    public function dataProvider_passes(): array
    {
        return [
            'same order' => [
                [1, 2, 3]
            ],
            'different order' => [
                [2, 3, 1]
            ],
        ];
    }

    public function dataProvider_given_and_message(): array
    {
        return [
            'a set' => [
                [2, 3, 4],
                <<<EOF
Failed asserting that set [2,3,4] is equal to set [1,2,3].

EOF,
            ],
            'not a set but an array' => [
                [2, 2, 4],
                <<<EOF
Failed asserting that [2,2,4] is equal to set [1,2,3].

EOF,
            ],
            'not a set nor an array' => [
                1,
                <<<EOF
Failed asserting that 1 is equal to set [1,2,3].

EOF,
            ],
        ];
    }
}
