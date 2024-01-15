<?php

namespace App\Examples\Tests;

// Framework de tests PHPUNIT
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes;

use App\Examples\Message;

class MessageTest extends TestCase
{

    protected Message $message;

    public function setUp():void
    {
        $this->message = new Message('en');
    }

    public function testLangEn()
    {
        $this->assertSame("Hello World!", $this->message->get());
    }
}
