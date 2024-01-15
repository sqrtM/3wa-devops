<?php

declare(strict_types=1);

namespace Exercise6;

use Exception;

class Calculator
{
    private bool $exception = false;
    private array $exceptionStrings = [];
    private string $regex = "/^\/\/(.+?)\n/";

    public function __construct()
    {
    }

    /**
     * @throws Exception
     */
    public function add(string $input): int
    {
        if (empty($input)) {
            return 0;
        }

        $numerals = $this->extractNumerals($input);

        foreach ($numerals as $numeral) {
            if (!is_numeric($numeral)) {
                $this->triggerException();
                $this->exceptionStrings[] = "Input contains a non-numeric character which is not a valid separator: $numeral";
            }
            $numeral = intval($numeral);
            if ($numeral < 0) {
                $this->triggerException();
                $this->exceptionStrings[] = "Negative number(s) not allowed : $numeral";
            }
        }

        if ($this->exception) {
            throw new Exception($this->expandExceptionString());
        }

        return array_sum($numerals);
    }

    private function expandExceptionString(): string
    {
        $result = "";
        foreach ($this->exceptionStrings as $exStr) {
            $result .= $exStr . "\n";
        }
        return $result;
    }

    private function triggerException(): void
    {
        if (!$this->exception) {
            $this->exception = true;
        }
    }

    private function extractNumerals(string $input): array
    {
        $separator = [];
        if (preg_match($this->regex, $input, $separator)) {
            $separatorChar = preg_quote($separator[1]);

            // this regex took me WAY too long for something so simple...
            $input = preg_replace($this->regex, "", $input);
            $pattern = "/($separatorChar|\n|,)/";
        } else {
            $pattern = "/[\\n,]/";
        }
        return preg_split($pattern, $input);
    }
}