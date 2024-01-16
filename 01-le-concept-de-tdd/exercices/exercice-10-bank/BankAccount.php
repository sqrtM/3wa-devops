<?php

declare(strict_types=1);

namespace Exercise10;

require __DIR__ . "/Account.php";

use DateTime;
use Exception;
use Random\RandomException;

class BankAccount implements Account
{

    /**
     * @var array<string, int>
     */
    private array $history = [];
    private int $balance = 0;

    /**
     * @throws RandomException
     */
    public function deposit(int $amount): void
    {
        $this->balance += $amount;
        $this->history[$this->generateDateIndex()] = $amount;
    }

    public function withdraw(int $amount): void
    {
        $this->balance -= $amount;
        $this->history[$this->generateDateIndex()] = -$amount;
    }

    /**
     * @throws Exception
     */
    public function printStatement(): void
    {
        $file = fopen("extrait.txt", "w") or throw new Exception("unable to open file");
        fwrite($file, "DATE       | AMOUNT | TOTAL\n");

        $balance = 0;
        foreach ($this->history as $key => $value) {
            $balance += $value;
            $line = "$key | $value | $balance\n";
            fwrite($file, $line);
        }

        fclose($file);
    }

    private function generateDateIndex(): string
    {
        $randomYear = rand(2000, 2022);
        $randomMonth = rand(1, 12);
        $randomDay = rand(1, 28);
        $randomDate = new DateTime("$randomYear-$randomMonth-$randomDay");
        return $randomDate->format('Y-m-d');
    }
}