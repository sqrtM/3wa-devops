<?php

declare(strict_types=1);

namespace Exercise9;

use Exception;

class Scanner
{
    private readonly array $barcodes;

    public function __construct()
    {
        $this->barcodes = [
            12345 => 725,
            23456 => 1250
        ];
    }

    /**
     * @param int[] $input
     * @return string
     * @throws Exception
     */
    public function scan(array $input = []): string
    {
        if (empty($input)) {
            throw new Exception('Erreur : code-barres vide');
        }

        $valueInCents = array_sum(array_map(array($this, 'lookup'), $input));

        $centValString = strval($valueInCents);
        return "$" . substr_replace($centValString, ".", strlen($centValString) - 2, 0);
    }

    /**
     * @throws Exception
     */
    private function lookup($c): int
    {
        if (is_null($this->barcodes[$c])) {
            throw new Exception('Erreur : code-barres non trouvé');
        } else {
            return $this->barcodes[$c];
        }
    }
}
