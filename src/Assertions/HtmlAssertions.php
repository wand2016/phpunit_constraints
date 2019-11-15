<?php

declare(strict_types=1);

namespace WandTa\Assertions;

use PHPUnit\Framework\TestCase;
use WandTa\Constraints\Html\HtmlNodeCount;
use WandTa\Constraints\Html\HtmlNodeInnerText;

trait HtmlAssertions
{
    public function assertHtmlNodeCount(
        string $selector,
        int $expectedCount,
        $html
    ): void
    {
        $constraint = new HtmlNodeCount($selector, $expectedCount);
        TestCase::assertThat($html, $constraint);
    }

    public function assertHtmlNodeInnerText(
        string $selector,
        string $expectedInnerText,
        $html
    ): void
    {
        $constraint = new HtmlNodeInnerText($selector, $expectedInnerText);
        TestCase::assertThat($html, $constraint);
    }
}
