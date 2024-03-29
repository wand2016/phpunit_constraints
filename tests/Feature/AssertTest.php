<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use WandTa\Assertions\HtmlAssertions;
use WandTa\Constraints\SetEquals;

class AssertTest extends TestCase
{
    use HtmlAssertions;

    /**
     * @test
     */
    public function Constraint_SetEquals_works(): void
    {
        $this->assertSetEquals(
            [1, 2, 3],
            [3, 1, 2]
        );
    }

    protected function assertSetEquals(
        array $expectedSet,
        $set
    ): void {
        $this->assertThat(
            $set,
            new SetEquals($expectedSet)
        );
    }

    /**
     * @test
     */
    public function assertHtmlNodeCount_works()
    {
        $this->assertHtmlNodeCount(
            'div',
            3,
            <<<EOL
<html>
  <body>
    <div>1</div>
    <div>2</div>
    <div>3</div>
  </body>
</html>
EOL
        );
    }

    /**
     * @test
     */
    public function assertHtmlNodeNotCount_works()
    {
        $this->assertHtmlNodeNotCount(
            'div',
            2,
            <<<EOL
<html>
  <body>
    <div>1</div>
    <div>2</div>
    <div>3</div>
  </body>
</html>
EOL
        );
    }

    /**
     * @test
     */
    public function assertHtmlNodeInnerText_works()
    {
        $this->assertHtmlNodeInnerText(
            'div.item:nth-of-type(2)',
            '2',
            <<<EOL
<html>
  <body>
    <div class="item">1</div>
    <div class="item">2</div>
    <div class="item">3</div>
  </body>
</html>
EOL
        );
    }

    /**
     * @test
     */
    public function assertHtmlNodeNotInnerText_works()
    {
        $this->assertHtmlNodeNotInnerText(
            'div.item:nth-of-type(2)',
            'hoge',
            <<<EOL
<html>
  <body>
    <div class="item">1</div>
    <div class="item">2</div>
    <div class="item">3</div>
  </body>
</html>
EOL
        );
    }

    /**
     * @test
     */
    public function assertHtmlNodeLinksTo_works()
    {
        $this->assertHtmlNodeLinksTo(
            'div.back a',
            '../menu.html',
            <<<EOL
<html>
  <body>
    <section class="content">brabra</section>
    <div class="back"><a href="../menu.html">back to menu</a></div>
  </body>
</html>
EOL
        );
    }

    /**
     * @test
     */
    public function assertHtmlNodeNotLinksTo_works()
    {
        $this->assertHtmlNodeNotLinksTo(
            'div.back a',
            '../index.html',
            <<<EOL
<html>
  <body>
    <section class="content">brabra</section>
    <div class="back"><a href="../menu.html">back to menu</a></div>
  </body>
</html>
EOL
        );
    }

    /**
     * @test
     */
    public function assertHtmlNodeExists_works()
    {
        $this->assertHtmlNodeExists(
            'section.content',
            <<<EOL
<html>
  <body>
    <section class="content">brabra</section>
    <div class="back"><a href="../menu.html">back to menu</a></div>
  </body>
</html>
EOL
        );
    }

    /**
     * @test
     */
    public function assertHtmlNodeNotExists_works()
    {
        $this->assertHtmlNodeNotExists(
            'main.content',
            <<<EOL
<html>
  <body>
    <section class="content">brabra</section>
    <div class="back"><a href="../menu.html">back to menu</a></div>
  </body>
</html>
EOL
        );
    }

    /**
     * @test
     */
    public function assertHtmlLinksTo_works()
    {
        $this->assertHtmlLinksTo(
            '../menu.html',
            <<<EOL
<html>
  <body>
    <section class="content">brabra</section>
    <div class="back"><a href="../menu.html">back to menu</a></div>
  </body>
</html>
EOL
        );
    }

    /**
     * @test
     */
    public function assertHtmlNotLinksTo_works()
    {
        $this->assertHtmlNotLinksTo(
            '../index.html',
            <<<EOL
<html>
  <body>
    <section class="content">brabra</section>
    <div class="back"><a href="../menu.html">back to menu</a></div>
  </body>
</html>
EOL
        );
    }
}
