<?php

declare(strict_types=1);

namespace WandTa\Constraints\Html;

use PHPUnit\Framework\Constraint\Constraint;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Given CSS selector specifies at least one node.
 */
class HtmlNodeExists extends Constraint
{
    /** @var string $selector */
    private $selector;

    /**
     * @param string $selector
     */
    public function __construct(
        string $selector
    ) {
        $this->selector = $selector;
    }

    /**
     * {@inheritDoc}
     */
    protected function matches($other): bool
    {
        return $this->getCountOf($other) > 0;
    }

    protected function getCountOf($other)
    {
        $dom = new Crawler();
        $dom->addHtmlContent($other);
        $filtered = $dom->filter($this->selector);

        return count($filtered);
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return \sprintf(
            'the node specified by given selector "%s" exists',
            $this->selector
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function failureDescription($other): string
    {
        return $this->toString();
    }
}
