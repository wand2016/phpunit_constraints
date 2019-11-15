<?php

declare(strict_types=1);

namespace WandTa\Assertions;

use PHPUnit\Framework\TestCase;
use WandTa\Constraints\Html\HtmlNodeCount;
use WandTa\Constraints\Html\HtmlNodeInnerText;

/**
 * Assertions on HTML
 */
trait HtmlAssertions
{
    /**
     * Asserts that the count of the nodes specified by the given selector
     * is equal to expected value.
     * @param string $selector
     * @param int $expectedCount
     * @param mixed $html
     * @return void
     */
    public function assertHtmlNodeCount(
        string $selector,
        int $expectedCount,
        $html
    ): void
    {
        $constraint = new HtmlNodeCount($selector, $expectedCount);
        TestCase::assertThat($html, $constraint);
    }

    /**
     * Asserts that the innerText of the nodes specified by the given selector
     * is equal to expected value.
     * @param string $selector
     * @param string  $expectedInnerText
     * @param mixed $html
     * @return void
     */
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
