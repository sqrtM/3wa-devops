<?php

declare(strict_types=1);

namespace Exercise7;

use Exception;
class Validator
{
    private array $exceptionMessages = [];

    public function __construct(
        private readonly string $input,
    ) {
    }

    /**
     * @throws Exception
     */
    public function validate(): void
    {
        if (!$this->atLeastEightChar()) {
            $this->exceptionMessages[] = "Password must be at least 8 characters.";
        }
        if (!$this->atLeastTwoNum()) {
            $this->exceptionMessages[] = "Password must have at least 2 numbers.";
        }
        if (!$this->atLeastOneUpperCase()) {
            $this->exceptionMessages[] = "Password must have at least 1 uppercase letter.";
        }
        if (!$this->atLeastOneSpecial()) {
            $this->exceptionMessages[] = "Password must have at least 1 special character.";
        }

        if (!empty($this->exceptionMessages)) {
            $message = implode("\n", $this->exceptionMessages);
            throw new Exception($message);
        };
    }

    private function atLeastEightChar(): bool
    {
        return (bool)preg_match("/^.{8,}$/", $this->input);
    }

    private function atLeastTwoNum(): bool
    {
        return (bool)preg_match("/^(.*\d){2,}.*$/", $this->input);
    }

    private function atLeastOneUpperCase(): bool
    {
        return (bool)preg_match("/[A-Z]/", $this->input);
    }

    private function atLeastOneSpecial(): bool
    {
        return (bool)preg_match("/[^a-zA-Z0-9]/", $this->input);
    }
}