<?php

declare(strict_types=1);

namespace Tests\Unit\Constraints\Html;

use PHPStan\Testing\TestCase;
use WandTa\Constraints\Html\HtmlNodeCount;

class HtmlNodeCountTest extends TestCase
{
    /** @var HtmlNodeCount $sut */
    private $sut;

    public function setUp(): void
    {
        parent::setUp();
        $this->sut = new HtmlNodeCount('div', 3);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testConstraintIsHtml(
        string $selector,
        int $countExpected,
        string $html,
        bool $expected
    ): void
    {
        $sut = new HtmlNodeCount($selector, $countExpected);
        $this->assertSame(
            $expected,
            $sut->evaluate($html, '', true)
        );
    }

    // ----------------------------------------
    // dataProvider
    // ----------------------------------------

    public function dataProvider(): array
    {
        $html = file_get_contents(__DIR__ . '/Sample/shakespeare.html');

        return [
            [
                'div',
                243,
                $html,
                true,
            ],
            [
                'div',
                242,
                $html,
                false,
            ],
            [
                'div',
                244,
                $html,
                false,
            ],
        ];
    }
}
