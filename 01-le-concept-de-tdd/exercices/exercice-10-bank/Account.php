<?php

namespace Exercise10;

interface Account
{
    public function deposit(int $amount): void;
    public function withdraw(int $amount): void;
    public function printStatement(): void;
}