<?php
declare(strict_types=1);

namespace Exercise5\tests;

use Exercise5\FizzBuzz;
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../FizzBuzz.php";

class FizzBuzzTest extends TestCase
{
    private FizzBuzz $fizzBuzz;
    protected function setUp(): void
    {
        parent::setUp();
        $this->fizzBuzz = new FizzBuzz();
    }

    public function testMultiplesOfThree() {
        self::assertEquals("Fizz", $this->fizzBuzz->fizzBuzz(6));
        self::assertEquals("Fizz", $this->fizzBuzz->fizzBuzz(9));
        self::assertEquals("Fizz", $this->fizzBuzz->fizzBuzz(12));
        self::assertEquals("Fizz", $this->fizzBuzz->fizzBuzz(18));
        self::assertEquals("Fizz", $this->fizzBuzz->fizzBuzz(21));

    }

    public function testMultiplesOfFive() {
        self::assertEquals("Buzz", $this->fizzBuzz->fizzBuzz(10));
        self::assertEquals("Buzz", $this->fizzBuzz->fizzBuzz(20));
        self::assertEquals("Buzz", $this->fizzBuzz->fizzBuzz(40));
        self::assertEquals("Buzz", $this->fizzBuzz->fizzBuzz(50));
        self::assertEquals("Buzz", $this->fizzBuzz->fizzBuzz(70));
        self::assertEquals("Buzz", $this->fizzBuzz->fizzBuzz(80));
    }

    public function testMultiplesOfThreeAndFive() {
        self::assertEquals("FizzBuzz", $this->fizzBuzz->fizzBuzz(15));
        self::assertEquals("FizzBuzz", $this->fizzBuzz->fizzBuzz(30));
        self::assertEquals("FizzBuzz", $this->fizzBuzz->fizzBuzz(60));
        self::assertEquals("FizzBuzz", $this->fizzBuzz->fizzBuzz(90));
        self::assertEquals("FizzBuzz", $this->fizzBuzz->fizzBuzz(120));
    }
}