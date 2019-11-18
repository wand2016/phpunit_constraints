<?php

declare(strict_types=1);

namespace WandTa\Assertions;

use PHPUnit\Framework\TestCase;
use WandTa\Constraints\Html\HtmlNodeAttribute;
use WandTa\Constraints\Html\HtmlNodeCount;
use WandTa\Constraints\Html\HtmlNodeExists;
use WandTa\Constraints\Html\HtmlNodeInnerText;

/**
 * Assertions on HTML
 * @mixin \PHPUnit\Framework\TestCase;
 */
trait HtmlAssertions
{
    /**
     * Asserts that the count of the nodes specified by given selector
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
    ): void {
        $constraint = new HtmlNodeCount($selector, $expectedCount);
        TestCase::assertThat($html, $constraint);
    }

    /**
     * Asserts that the innerText of the first node specified by given selector
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
    ): void {
        $constraint = new HtmlNodeInnerText($selector, $expectedInnerText);
        TestCase::assertThat($html, $constraint);
    }

    /**
     * Asserts that the href attribute of the first node specified by given selector
     * is equal to expected value.
     * @param string $selector
     * @param string $expectedHref
     * @param mixed $html
     * @return void
     */
    public function assertHtmlNodeLinksTo(
        string $selector,
        string $expectedHref,
        $html
    ): void {
        $constraint = new HtmlNodeAttribute($selector, 'href', $expectedHref);
        TestCase::assertThat($html, $constraint);
    }

    /**
     * Asserts that the node specified by given selector exists.
     * @param string $selector
     * @param mixed $html
     * @return void
     */
    public function assertHtmlNodeExists(
        string $selector,
        $html
    ): void {
        $constraint = new HtmlNodeExists($selector);
        TestCase::assertThat($html, $constraint);
    }

    /**
     * Asserts that there is <a> element whose href attribute is expected value.
     * @param string $expectedHref
     * @param mixed $html
     * @return void
     */
    public function assertHtmlLinksTo(
        string $expectedHref,
        $html
    ): void {
        $constraint = new HtmlNodeExists(sprintf('a[href="%s"]', $expectedHref));
        TestCase::assertThat($html, $constraint);
    }
}
