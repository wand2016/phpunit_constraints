<?php

declare(strict_types=1);

namespace WandTa\Constraints\Html;

use DOMDocument;
use PHPUnit\Framework\Constraint\Constraint;
use Symfony\Component\DomCrawler\Crawler;

/**
 *
 */
class HtmlNodeCount extends Constraint
{
    /** @var string $selector */
    private $selector;

    /** @var int $countExpected */
    private $countExpected;

    /**
     * @param string $selector
     * @param int $countExpected
     */
    public function __construct(
        string $selector,
        int $countExpected
    )
    {
        $this->selector = $selector;
        $this->countExpected = $countExpected;
    }

    /**
     * {@inheritDoc}
     */
    protected function matches($other): bool
    {
        $dom = new Crawler();
        $dom->addHtmlContent($other);
        $filtered = $dom->filter($this->selector);

        return count($filtered) === $this->countExpected;
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return 'is HTML';
    }
}
