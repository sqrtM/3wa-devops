<?php

namespace App\Tests\Model;

use App\Model\Number;
use App\Model\NumberString;
use App\Model\Sub;
use PHPUnit\Framework\TestCase;

class CalculModelTest extends TestCase
{
    private Sub $sub;
    private Number $three;
    private Number $two;
    private NumberString $numberString;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sub = new Sub();
        $this->three = new Number(3);
        $this->two = new Number(2);
        $this->numberString = new NumberString(5);
    }

    public function testSub()
    {
        $one = new NumberString(3 - 2);
        self::assertEquals($one, $this->sub->exec($this->three, $this->two));
    }

    public function testNumber()
    {
        self::assertEquals(3, $this->three->getNumber());
    }
    public function testNumberString()
    {
        self::assertEquals("5.0", $this->numberString);
    }

}
