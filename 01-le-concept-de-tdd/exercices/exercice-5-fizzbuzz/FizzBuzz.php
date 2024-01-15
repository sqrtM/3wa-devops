<?php
declare(strict_types=1);

namespace Exercise5;

class FizzBuzz
{
    public function __construct() {
    }

    public function fizzBuzz(int $input): string {
        if ($input % 3 === 0 && $input % 5 == 0) {
            return "FizzBuzz";
        } elseif ($input % 5 === 0) {
            return "Buzz";
        } elseif ($input % 3 === 0) {
            return "Fizz";
        } else {
            return "";
        }
    }
}