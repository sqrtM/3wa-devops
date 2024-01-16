<?php

declare(strict_types=1);

namespace Exercise9\tests;

use Exception;
use Exercise9\Scanner;
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../Scanner.php";


class ScannerTest extends TestCase
{
    private Scanner $scanner;

    protected function setUp(): void
    {
        parent::setUp();
        $this->scanner = new Scanner();
    }

    /**
     * @throws Exception
     */
    public function testFirstCode()
    {
        self::assertEquals("$7.25", $this->scanner->scan([12345]));
    }

    /**
     * @throws Exception
     */
    public function testSecondCode()
    {
        self::assertEquals("$12.50", $this->scanner->scan([23456]));
    }

    /**
     * @throws Exception
     */
    public function testInvalidCode()
    {
        $this->expectExceptionMessage('Erreur : code-barres non trouvé');
        $this->scanner->scan([999]);
    }

    /**
     * @throws Exception
     */
    public function testEmptyCode()
    {
        $this->expectExceptionMessage('Erreur : code-barres vide');
        $this->scanner->scan();
    }

    /**
     * @throws Exception
     */
    public function testSummedCodes()
    {
        self::assertEquals("$19.75", $this->scanner->scan([12345, 23456]));
    }
}