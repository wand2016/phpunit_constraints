<?php

declare(strict_types=1);

namespace Tests\Unit\Constraints\Html;

use PHPStan\Testing\TestCase;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestFailure;
use WandTa\Constraints\Html\HtmlNodeCount;

class HtmlNodeCountTest extends TestCase
{
    /** @var HtmlNodeCount $sut */
    private $sut;

    public function setUp(): void
    {
        parent::setUp();
        $this->sut = new HtmlNodeCount('div', 243);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testConstraintHtmlNodeCount(
        string $selector,
        int $countExpected,
        string $html,
        bool $expected
    ): void {
        $sut = new HtmlNodeCount($selector, $countExpected);
        $this->assertSame(
            $expected,
            $sut->evaluate($html, '', true)
        );
    }

    public function testConstraintHtmlNodeCount_toString(): void
    {
        $expected = <<<EOL
count matches 243
EOL;

        $this->assertSame($expected, $this->sut->toString());
    }

    public function testConstraintHtmlNodeCount_evaluateException(): void
    {
        try {
            $this->sut->evaluate('<html></html>');
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                <<<EOL
Failed asserting that actual size 0 matches expected size 243.

EOL,
                TestFailure::exceptionToString($e)
            );

            return;
        }

        $this->fail();
    }

    // ----------------------------------------
    // dataProvider
    // ----------------------------------------

    public function dataProvider(): array
    {
        $html = file_get_contents(__DIR__ . '/Sample/shakespeare.html');

        return [
            'equal' => [
                'div',
                243,
                $html,
                true,
            ],
            'not equal (-1)' => [
                'div',
                242,
                $html,
                false,
            ],
            'not equal (+1)' => [
                'div',
                244,
                $html,
                false,
            ],
            'equal (filtered with css)' => [
                'div.dialog',
                51,
                $html,
                true,
            ],
            'unknown element' => [
                'hoge',
                0,
                $html,
                true,
            ],
            'known element with unused class' => [
                'div.hoge',
                0,
                $html,
                true,
            ],
        ];
    }
}
