<?php

declare(strict_types=1);

namespace Tests\Unit\Constraints\Html;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestFailure;
use WandTa\Constraints\Html\HtmlNodeAttribute;

class HtmlNodeAttributeTest extends TestCase
{
    /**
     * @test
     */
    public function passes(): void
    {
        $html = file_get_contents(__DIR__ . '/Sample/sample_attribute.html');

        $sut = new HtmlNodeAttribute('div.back a', 'href', '../menu.html');

        $this->assertTrue($sut->evaluate($html, '', true));
    }

    /**
     * @test
     */
    public function passes_with_null(): void
    {
        $html = file_get_contents(__DIR__ . '/Sample/sample_attribute.html');

        $sut = new HtmlNodeAttribute('div.back a', 'target', null);

        $this->assertTrue($sut->evaluate($html, '', true));
    }

    /**
     * @test
     */
    public function fails_when_no_node_is_specified(): void
    {
        $html = file_get_contents(__DIR__ . '/Sample/sample_attribute.html');

        $sut = new HtmlNodeAttribute('div.prev a', 'href', '../menu.html');

        $this->assertFalse($sut->evaluate($html, '', true));
    }

    /**
     * @test
     */
    public function fails_different_attribute_value(): void
    {
        $html = file_get_contents(__DIR__ . '/Sample/sample_attribute.html');

        $sut = new HtmlNodeAttribute('div.back a', 'href', '../top.html');

        $this->assertFalse($sut->evaluate($html, '', true));
    }

    /**
     * @test
     */
    public function fails_no_such_attribute(): void
    {
        $html = file_get_contents(__DIR__ . '/Sample/sample_attribute.html');

        $sut = new HtmlNodeAttribute('div.back a', 'target', '');

        $this->assertFalse($sut->evaluate($html, '', true));
    }

    /**
     * @test
     */
    public function toString_expected_format(): void
    {
        $sut = new HtmlNodeAttribute('div.back a', 'href', '../menu.html');
        $this->assertSame(
            '"../menu.html" is href attribute of the first node specified by given selector "div.back a"',
            $sut->toString()
        );
    }

    /**
     * @test
     * @dataProvider dataProvider_exceptionMessage
     */
    public function evaluateExceptionMessage(
        string $selector,
        string $attributeName,
        ?string $expectedAttributeValue,
        string $expectedMessage
    ): void {
        $html = file_get_contents(__DIR__ . '/Sample/sample_attribute.html');
        $sut = new HtmlNodeAttribute(
            $selector,
            $attributeName,
            $expectedAttributeValue
        );

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
                'div.prev a',
                'href',
                '../menu.html',
                <<<EOL
Failed asserting that "../menu.html" is href attribute of the first node specified by given selector "div.prev a".
No node is specified by given selector "div.prev a".

EOL,
            ],
            'different value' => [
                'div.back a',
                'href',
                '../top.html',
                <<<EOL
Failed asserting that "../top.html" is href attribute of the first node specified by given selector "div.back a".

EOL,
            ],
        ];
    }
}
