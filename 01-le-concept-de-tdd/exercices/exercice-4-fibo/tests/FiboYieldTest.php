<?php

namespace App\Tests;

use App\FiboYield;
use PHPUnit\Framework\TestCase;

class FiboYieldTest extends TestCase
{
    protected FiboYield $fibo;
    public function setUp(): void
    {
        $this->fibo = new FiboYield();
    }

    public function testFirstsYieldTermSuite()
    {
        $this->assertEquals(1, $this->fibo->run()->current());
    }

    public function testConsecutiveYieldTermSuite()
    {
        $gen = $this->fibo->run();

        $this->assertEquals(1, $gen->current());
        $gen->next();
        $this->assertEquals(1, $gen->current());
        $gen->next();
        $this->assertEquals(2, $gen->current());
        $gen->next();
        $this->assertEquals(3, $gen->current());
        $gen->next();
        $this->assertEquals(5, $gen->current());
    }
}