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
        $maybeFirst = $this->tryGetFirst($other);
        if (count($maybeFirst) === 0) {
            return false;
        }

        return $maybeFirst->text() === $this->expectedInnerText;
    }

    /**
     * try to get the first node specified by the given selector
     * @param mixed $other html
     * @return Crawler with at most one node
     */
    protected function tryGetFirst($other): Crawler
    {
        $dom = new Crawler();
        $dom->addHtmlContent($other);
        $maybeFirst = $dom->filter($this->selector)->first();
        return $maybeFirst;
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
