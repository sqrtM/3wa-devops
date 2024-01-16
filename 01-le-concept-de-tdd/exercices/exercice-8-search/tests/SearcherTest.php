<?php

declare(strict_types=1);

namespace Exercise8\tests;

use Exercise8\Searcher;
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../Searcher.php";


class SearcherTest extends TestCase
{
    private Searcher $searcher;

    protected function setUp(): void
    {
        parent::setUp();
        $this->searcher = new Searcher();
    }

    /**
     * @throws \Exception
     */
    public function testInputRequiresAtLeast2Characters()
    {
        $this->expectExceptionMessage("2 characters");
        $this->searcher->search("2");
    }

    /**
     * @throws \Exception
     */
    public function testReturnsExactMatches()
    {
        $vaMatches = $this->searcher->search("Va");
        self::assertContains("Vancouver", $vaMatches);
        self::assertContains("Valence", $vaMatches);

        $apeMatches = $this->searcher->search("ape");
        self::assertContains("Budapest", $apeMatches);
    }

    /**
     * @throws \Exception
     */
    public function testNotCaseSensitive()
    {
        $matches = $this->searcher->search("va");
        self::assertContains("Vancouver", $matches);
        self::assertContains("Valence", $matches);
    }

    /**
     * @throws \Exception
     */
    public function testAsteriskReturnsAll()
    {
        $matches = $this->searcher->search("*");
        self::assertCount(16, $matches);
    }
}
