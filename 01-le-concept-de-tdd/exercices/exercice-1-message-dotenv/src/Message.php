<?php

namespace App;

class Message
{
    protected $array = [];
    private string $lang;
    public function __construct(
        private array $translates = [
            'fr' => 'Bonjour tout le monde!',
            'en' => 'Hello World!'
        ]
    ) 
    {
        $this->lang = $_ENV['LANGUAGE'];
    }

    public function get(): string
    {
        return $this->translates[$this->lang];
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function setLang(string $lang): void
    {
        $this->lang = $lang;
    }

    public function getArray(): array
    {
        return $this->array;
    }

    public function add(int $number): void
    {
        $this->array[] = $number;
    }
}
