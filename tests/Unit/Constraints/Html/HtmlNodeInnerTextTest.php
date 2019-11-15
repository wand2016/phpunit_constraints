<?php

declare(strict_types=1);

namespace Tests\Unit\Constraints\Html;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestFailure;
use WandTa\Constraints\Html\HtmlNodeInnerText;

class HtmlNodeInnerTextTest extends TestCase
{
    /**
     * @test
     */
    public function passes()
    {
        $html = file_get_contents(__DIR__ . '/Sample/shakespeare.html');

        $sut = new HtmlNodeInnerText('h2', 'As You Like It');

        $this->assertTrue($sut->evaluate($html, '', true));
    }

    /**
     * @test
     */
    public function fails_empty_set()
    {
        $html = file_get_contents(__DIR__ . '/Sample/shakespeare.html');

        $sut = new HtmlNodeInnerText('h1', 'As You Like It');

        $this->assertFalse($sut->evaluate($html, '', true));
    }

    /**
     * @test
     */
    public function fails_different_content()
    {
        $html = file_get_contents(__DIR__ . '/Sample/shakespeare.html');

        $sut = new HtmlNodeInnerText('h2', 'As You Hate It');

        $this->assertFalse($sut->evaluate($html, '', true));
    }

    /**
     * @test
     */
    public function toString_()
    {
        $sut = new HtmlNodeInnerText('h2', 'As You Like It');
        $this->assertSame(
            '"As You Like It" is the innerText of the first node specified with the given selector "h2"',
            $sut->toString()
        );
    }

    /**
     * @test
     * @dataProvider dataProvider_exceptionMessage
     */
    public function evaluateExceptionMessage(
        string $selector,
        string $expectedInnerText,
        string $expectedMessage
    ): void
    {
        $html = file_get_contents(__DIR__ . '/Sample/shakespeare.html');
        $sut = new HtmlNodeInnerText($selector, $expectedInnerText);

        try {
            $sut->evaluate($html);
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

    public function dataProvider_exceptionMessage(): array
    {
        return [
            'no node is specified' => [
                'h1',
                'As You Like It',
                <<<EOL
Failed asserting that "As You Like It" is the innerText of the first node specified with the given selector "h1".

EOL,
            ],
            'innerText is different' => [
                'h2',
                'As You Hate It',
                <<<EOL
Failed asserting that "As You Hate It" is the innerText of the first node specified with the given selector "h2".

EOL,
            ],
        ];
    }
}
