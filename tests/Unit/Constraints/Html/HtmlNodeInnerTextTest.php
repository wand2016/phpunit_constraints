<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
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
            'the innerText of the first node specified with the given selector is "As You Like It"',
            $sut->toString()
        );
    }
}
