<?php

declare(strict_types=1);

namespace Exercise10\tests;

require __DIR__ . "/../BankAccount.php";

use Exception;
use Exercise10\BankAccount;
use PHPUnit\Framework\TestCase;

class BankAccountTest extends TestCase
{
    private BankAccount $account;

    protected function setUp(): void
    {
        parent::setUp();
        $this->account = new BankAccount();
    }

    public function testDeposit()
    {
        $accountMock = $this->getMockBuilder(BankAccount::class)
            ->onlyMethods(['deposit'])
            ->getMock();

        $accountMock->expects($this->once())
            ->method('deposit')
            ->with($this->equalTo(100));

        $accountMock->deposit(100);
    }

    public function testWithdraw()
    {
        $accountMock = $this->getMockBuilder(BankAccount::class)
            ->onlyMethods(['withdraw'])
            ->getMock();

        $accountMock->expects($this->once())
            ->method('withdraw')
            ->with($this->equalTo(50));

        $accountMock->withdraw(50);
    }

    /**
     * @throws Exception
     */
    public function testPrintStatement()
    {
        $this->account->deposit(50);
        $this->account->withdraw(20);
        $this->account->deposit(500);
        $this->account->withdraw(200);
        $this->account->printStatement();

        $file = fopen("extrait.txt", 'r');
        if (!$file) {
            throw new Exception("Unable to open file");
        }

        $lineCount = 0;
        while (!feof($file)) {
            fgets($file);
            $lineCount++;
        }
        fclose($file);

        self::assertEquals(6, $lineCount);
    }
}