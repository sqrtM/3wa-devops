<?php
declare(strict_types=1);

namespace Exercise8;

use Exception;

class Searcher
{
    private readonly array $cities;

    public function __construct()
    {
        $this->cities = [
            "Paris",
            "Budapest",
            "Skopje",
            "Rotterdam",
            "Valence",
            "Vancouver",
            "Amsterdam",
            "Vienne",
            "Sydney",
            "New York City",
            "Londres",
            "Bangkok",
            "Hong Kong",
            "Dubaï",
            "Rome",
            "Istanbul"
        ];
    }

    /**
     * @throws Exception
     */
    public function search(string $input): array
    {
        if ($input === "*") {
            return $this->cities;
        } elseif (strlen($input) < 2) {
            throw new Exception("Input cannot be less than 2 characters long.");
        }

        return array_filter($this->cities, function ($c) use ($input) {
            return str_contains(strtolower($c), strtolower($input));
        });
    }
}
