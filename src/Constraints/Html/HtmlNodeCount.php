<?php

declare(strict_types=1);

namespace WandTa\Constraints\Html;

use PHPUnit\Framework\Constraint\Constraint;
use Symfony\Component\DomCrawler\Crawler;

/**
 *
 */
class HtmlNodeCount extends Constraint
{
    /** @var string $selector */
    private $selector;

    /** @var int $expectedCount */
    private $expectedCount;

    /**
     * @param string $selector
     * @param int $expectedCount
     */
    public function __construct(
        string $selector,
        int $expectedCount
    )
    {
        $this->selector = $selector;
        $this->expectedCount = $expectedCount;
    }

    /**
     * {@inheritDoc}
     */
    protected function matches($other): bool
    {
        $dom = new Crawler();
        $dom->addHtmlContent($other);
        $filtered = $dom->filter($this->selector);

        return count($filtered) === $this->expectedCount;
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'is HTML';
    }
}
