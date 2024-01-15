<?php

declare(strict_types=1);

namespace Exercise5;

class FizzBuzz
{
    public function __construct()
    {
    }

    public function fizzBuzz(int $input): string
    {
        $string = "";
        if ($input % 3 === 0) {
            $string .= "Fizz";
        }
        if ($input % 5 === 0) {
            $string .= "Buzz";
        }
        return $string;
    }
}