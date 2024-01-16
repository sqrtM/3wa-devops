<?php

namespace App\Tests;

use App\Fibo;
use PHPUnit\Framework\TestCase;

class FiboTest extends TestCase
{
    protected Fibo $fibo;

    public function setUp(): void
    {
        $this->fibo = new Fibo(max: 10);
        $this->fibo->run();
    }

    public function testDefaultMax()
    {
        // instance de reflexion class avec le type de classe
        $reflectionClass = new \ReflectionClass(Fibo::class);
        // récupérer la pp
        $reflectionProperty = $reflectionClass->getProperty('max');
        // on rend accessible la pp
        $reflectionProperty->setAccessible(true);
        // on accède à la pp en repassant l'instance de Fibo à getValue
        $max = $reflectionProperty->getValue(new Fibo()) ;

        $this->assertSame(20, $max);
    }

    public function testFirstsTermSuite()
    {
        // assignation des valeurs nouvelle syntaxe PHP
        [$num1, $num2] = [$this->fibo->terms[0], $this->fibo->terms[1]];

        $this->assertEquals(1, $num1);
        $this->assertEquals(1, $num2);
    }

    /**
     * @dataProvider terms
     */
    public function testConsecutiveTerm($a, $b, $expected, $n)
    {
        [$num1, $num2] = [$this->fibo->terms[$n - 1], $this->fibo->terms[$n]];

        $this->assertEquals($num1, $a);
        $this->assertEquals($num2, $b);
        $this->assertEquals($expected, $num1 + $num2);
    }

    public static function terms(): array
    {
        return [
            [1, 1, 2, 1],
            [1, 2, 3, 2],
            [2, 3, 5, 3],
            [3, 5, 8, 4],
            [5, 8, 13, 5],
            [8, 13, 21, 6],
            [13, 21, 34, 7],
            [21, 34, 55, 8],
            [34, 55, 89, 9],
            [55, 89, 144, 10],
        ];
    }
}