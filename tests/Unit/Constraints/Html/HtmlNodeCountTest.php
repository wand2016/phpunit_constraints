<?php

declare(strict_types=1);

namespace Tests\Unit\Constraints\Html;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestFailure;
use WandTa\Constraints\Html\HtmlNodeCount;

class HtmlNodeCountTest extends TestCase
{
    /**
     * @test
     */
    public function passes()
    {
        $html = file_get_contents(__DIR__ . '/Sample/shakespeare.html');

        $sut = new HtmlNodeCount('div', 243);

        $this->assertTrue($sut->evaluate($html, '', true));
    }

    /**
     * @test
     */
    public function passes_with_empty_set()
    {
        $html = file_get_contents(__DIR__ . '/Sample/shakespeare.html');

        $sut = new HtmlNodeCount('h1', 0);

        $this->assertTrue($sut->evaluate($html, '', true));
    }

    /**
     * @test
     */
    public function toString_expected_format(): void
    {
        $sut = new HtmlNodeCount('div', 243);

        $expected = <<<EOL
count matches 243
EOL;

        $this->assertSame($expected, $sut->toString());
    }

    /**
     * @test
     */
    public function evaluateException(): void
    {
        try {
            $sut = new HtmlNodeCount('div', 1);
            $sut->evaluate('<html></html>');
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                <<<EOL
Failed asserting that actual size 0 matches expected size 1.

EOL,
                TestFailure::exceptionToString($e)
            );

            return;
        }

        $this->fail();
    }
}
