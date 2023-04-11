<?php

namespace App\Models\Enums;

enum CryptoEntriesTrendEnum: string
{
    use EnumToArray;

    case buy = 'Achat';
    case sell = 'Vente';

    public static function fromName(string $name)
    {

        return constant("self::$name");
    }
}
