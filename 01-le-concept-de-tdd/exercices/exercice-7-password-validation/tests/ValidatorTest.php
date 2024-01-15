<?php

declare(strict_types=1);

namespace Exercise7\tests;

use Exception;
use Exercise7\Validator;
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../Validator.php";


class ValidatorTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAtLeastEightCharacters()
    {
        $this->expectExceptionMessage("Password must be at least 8 characters.");
        $validator = new Validator("A'BCDEF");
        $validator->validate();
    }

    /**
     * @throws Exception
     */
    public function testAtLeastTwoNumbers()
    {
        $this->expectExceptionMessage("Password must have at least 2 numbers.");
        $validator = new Validator("ABCDEFGHIJ(K");
        $validator->validate();
    }

    /**
     * @throws Exception
     */
    public function testAtLeastOneUppercase()
    {
        $this->expectExceptionMessage("Password must have at least 1 uppercase letter.");
        $validator = new Validator("abcdefg1234$");
        $validator->validate();
    }

    /**
     * @throws Exception
     */
    public function testAtLeastOneSpecialCharacter()
    {
        $this->expectExceptionMessage("Password must have at least 1 special character.");
        $validator = new Validator("Abcdefg1234");
        $validator->validate();
    }

    /**
     * @throws Exception
     */
    public function testConcatErrors()
    {
        $this->expectExceptionMessage("Password must be at least 8 characters.\nPassword must have at least 2 numbers.\nPassword must have at least 1 uppercase letter.\nPassword must have at least 1 special character.");
        $validator = new Validator("avcvds");
        $validator->validate();;
    }
}