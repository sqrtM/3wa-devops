<?php

namespace App\Tests;

// Framework de tests PHPUNIT
use PHPUnit\Framework\TestCase;

use App\Message;

use function PHPUnit\Framework\assertEquals;

class MessageTest extends TestCase
{
    private Message $message;

    protected function setUp(): void
    {
        parent::setUp();
        $this->message = new Message();
    }

    public function testEnvContainsDefaultLanguage() {
        self::assertEquals($_ENV['LANGUAGE'], $this->message->getLang());
    }

    public function testLangSetsCorrectly() {
        $this->message->setLang('en');
        self::assertEquals('en', $this->message->getLang());
    }

    public function testGetArray() {
        if ($_ENV['LANGUAGE'] == 'fr') {
            assertEquals('Bonjour tout le monde!', $this->message->get());
        } elseif ($_ENV['LANGUAGE'] == 'en') {
            assertEquals('Hello World!', $this->message->get());
        } else {
            self::fail();
        }
    }
}
