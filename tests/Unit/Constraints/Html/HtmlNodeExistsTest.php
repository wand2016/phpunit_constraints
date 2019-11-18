<?php

declare(strict_types=1);

namespace Tests\Unit\Constraints\Html;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestFailure;
use WandTa\Constraints\Html\HtmlNodeCount;
use WandTa\Constraints\Html\HtmlNodeExists;

class HtmlNodeExistsTest extends TestCase
{
    /**
     * @test
     */
    public function passes(): void
    {
        $html = file_get_contents(__DIR__ . '/Sample/shakespeare.html');

        $sut = new HtmlNodeExists('div');

        $this->assertTrue($sut->evaluate($html, '', true));
    }

    /**
     * @test
     * @dataProvider dataProvider_not_exists
     */
    public function fails(): void
    {
        $html = file_get_contents(__DIR__ . '/Sample/shakespeare.html');

        $sut = new HtmlNodeExists('span');

        $this->assertFalse($sut->evaluate($html, '', true));
    }

    /**
     * @test
     */
    public function toString_expected_format(): void
    {
        $sut = new HtmlNodeExists('div');

        $expected = <<<EOL
the node specified by given selector "div" exists
EOL;

        $this->assertSame($expected, $sut->toString());
    }

    /**
     * @test
     */
    public function evaluateException(): void
    {
        try {
            $sut = new HtmlNodeExists('div');
            $sut->evaluate('<html></html>');
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                <<<EOL
Failed asserting that the node specified by given selector "div" exists.

EOL,
                TestFailure::exceptionToString($e)
            );

            return;
        }

        $this->fail();
    }

    // ----------------------------------------
    // dataProviders
    // ----------------------------------------

    public function dataProvider_not_exists(): iterable
    {
        yield [
            'head',
        ];

        yield [
            'div.hoge',
        ];
    }
}
