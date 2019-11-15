<?php

declare(strict_types=1);

namespace WandTa\Constraints\Html;

use PHPUnit\Framework\Constraint\Constraint;
use Symfony\Component\DomCrawler\Crawler;

class HtmlNodeInnerText extends Constraint
{
    /** @var string $selector */
    private $selector;

    /** @var string $expectedInnerText */
    private $expectedInnerText;

    /**
     * @param string $selector
     * @param string $expectedInnerText
     */
    public function __construct(
        string $selector,
        string $expectedInnerText
    ) {
        $this->selector = $selector;
        $this->expectedInnerText = $expectedInnerText;
    }

    /**
     * {@inheritDoc}
     */
    protected function matches($other): bool
    {
        $dom = new Crawler();
        $dom->addHtmlContent($other);
        $first = $dom->filter($this->selector)->first();
        if (count($first) === 0) {
            return false;
        }

        return $first->text() === $this->expectedInnerText;
    }

    /**
     * {@inheritDoc}
     */
    protected function failureDescription($other): string
    {
        return $this->toString();
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return \sprintf(
            '"%s" is the innerText of the first node specified with the given selector "%s"',
            $this->expectedInnerText,
            $this->selector
        );
    }
}
