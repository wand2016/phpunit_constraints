<?php

declare(strict_types=1);

namespace WandTa\Constraints\Html;

use PHPUnit\Framework\Constraint\Constraint;
use Symfony\Component\DomCrawler\Crawler;

/**
 * The attribute specified by given CSS selector and attribute name
 * is equal to given value.
 */
class HtmlNodeAttribute extends Constraint
{
    /** @var string $selector */
    private $selector;

    /** @var string $attributeName */
    private $attributeName;

    /** @var string|null $expectedAttributeValue */
    private $expectedAttributeValue;

    /**
     * @param string $selector
     * @param string $attributeName
     * @param string|null $expectedAttributeValue
     *        when null is given, it means that the attribute shouldn't be set.
     */
    public function __construct(
        string $selector,
        string $attributeName,
        ?string $expectedAttributeValue
    ) {
        $this->selector = $selector;
        $this->attributeName = $attributeName;
        $this->expectedAttributeValue = $expectedAttributeValue;
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

        return $maybeFirst->first()->attr($this->attributeName)
            === $this->expectedAttributeValue;
    }

    /**
     * try to get the first node specified by the given selector
     * @param mixed $other html
     * @return Crawler with at most one node
     * @todo refactoring/extracting to function
     */
    protected function tryGetFirst($other): Crawler
    {
        $dom = new Crawler();
        $dom->addHtmlContent((string) $other);
        $maybeFirst = $dom->filter($this->selector)->first();
        return $maybeFirst;
    }

    /**
     * {@inheritDoc}
     */
    protected function failureDescription($other): string
    {
        $maybeFirst = $this->tryGetFirst($other);

        if ($maybeFirst->count() > 0) {
            return $this->toString();
        }

        return sprintf(
            '%s.' . PHP_EOL
                . 'No node is specified by given selector "%s"',
            $this->toString(),
            $this->selector
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return \sprintf(
            '"%s" is %s attribute of the first node specified by given selector "%s"',
            $this->expectedAttributeValue,
            $this->attributeName,
            $this->selector
        );
    }
}
