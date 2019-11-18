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
        TestCase::assertThat(
            $html,
            self::htmlNodeCount($selector, $expectedCount)
        );
    }

    /**
     * Asserts that the count of the nodes specified by given selector
     * is NOT equal to expected value.
     * @param string $selector
     * @param int $expectedCount
     * @param mixed $html
     * @return void
     */
    public function assertHtmlNodeNotCount(
        string $selector,
        int $expectedCount,
        $html
    ): void {
        TestCase::assertThat(
            $html,
            TestCase::logicalNot(
                self::htmlNodeCount($selector, $expectedCount)
            )
        );
    }

    /**
     * Creates the constraint
     * where the count of the nodes specified by given selector
     * is equal to expected value.
     * @param string $selector
     * @param int $expectedCount
     * @return HtmlNodeCount
     */
    public static function htmlNodeCount(
        string $selector,
        int $expectedCount
    ): HtmlNodeCount {
        return new HtmlNodeCount($selector, $expectedCount);
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
        TestCase::assertThat(
            $html,
            self::htmlNodeInnerText($selector, $expectedInnerText)
        );
    }

    /**
     * Asserts that the innerText of the first node specified by given selector
     * is NOT equal to expected value.
     * @param string $selector
     * @param string  $expectedInnerText
     * @param mixed $html
     * @return void
     */
    public function assertHtmlNodeNotInnerText(
        string $selector,
        string $expectedInnerText,
        $html
    ): void {
        TestCase::assertThat(
            $html,
            TestCase::logicalNot(
                self::htmlNodeInnerText($selector, $expectedInnerText)
            )
        );
    }

    /**
     * Create the constraint
     * where the innerText of the first node specified by given selector
     * is equal to expected value.
     * @param string $selector
     * @param string  $expectedInnerText
     * @return HtmlNodeInnerText
     */
    public static function htmlNodeInnerText(
        string $selector,
        string $expectedInnerText
    ): HtmlNodeInnerText {
        return new HtmlNodeInnerText($selector, $expectedInnerText);
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
        TestCase::assertThat(
            $html,
            self::htmlNodeLinksTo($selector, $expectedHref)
        );
    }

    /**
     * Asserts that the href attribute of the first node specified by given selector
     * is NOT equal to expected value.
     * @param string $selector
     * @param string $expectedHref
     * @param mixed $html
     * @return void
     */
    public function assertHtmlNodeNotLinksTo(
        string $selector,
        string $expectedHref,
        $html
    ): void {
        TestCase::assertThat(
            $html,
            TestCase::logicalNot(
                self::htmlNodeLinksTo($selector, $expectedHref)
            )
        );
    }

    /**
     * Creates the constraint
     * where the href attribute of the first node specified by given selector
     * is equal to expected value.
     * @param string $selector
     * @param string $expectedHref
     * @return HtmlNodeAttribute
     */
    public static function htmlNodeLinksTo(
        string $selector,
        string $expectedHref
    ): HtmlNodeAttribute {
        return new HtmlNodeAttribute($selector, 'href', $expectedHref);
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
        TestCase::assertThat(
            $html,
            self::htmlNodeExists($selector)
        );
    }

    /**
     * Asserts that the node specified by given selector DOESN'T exist.
     * @param string $selector
     * @param mixed $html
     * @return void
     */
    public function assertHtmlNodeNotExists(
        string $selector,
        $html
    ): void {
        TestCase::assertThat(
            $html,
            TestCase::logicalNot(
                self::htmlNodeExists($selector)
            )
        );
    }

    /**
     * Creates the constraint
     * where the node specified by given selector exists.
     * @param string $selector
     * @return HtmlNodeExists
     */
    public static function htmlNodeExists(string $selector): HtmlNodeExists
    {
        return new HtmlNodeExists($selector);
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
        TestCase::assertThat(
            $html,
            self::htmlLinksTo($expectedHref)
        );
    }

    /**
     * Asserts that there is <a> element whose href attribute is expected value.
     * @param string $expectedHref
     * @param mixed $html
     * @return void
     */
    public function assertHtmlNotLinksTo(
        string $expectedHref,
        $html
    ): void {
        TestCase::assertThat(
            $html,
            TestCase::logicalNot(
                self::htmlLinksTo($expectedHref)
            )
        );
    }

    /**
     * Creates the constraint
     * where there is <a> element whose href attribute is expected value.
     * @param string $expectedHref
     * @return HtmlNodeExists
     */
    public static function htmlLinksTo(string $expectedHref): HtmlNodeExists
    {
        return new HtmlNodeExists(sprintf('a[href="%s"]', $expectedHref));
    }
}
