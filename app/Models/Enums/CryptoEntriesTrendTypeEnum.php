<?php

namespace App\Models\Enums;

enum CryptoEntriesTrendTypeEnum: string
{
    use EnumToArray;

    case bullish = 'Haussière';
    case bearish = 'Baissière';
    case range = 'Range';

    public static function fromName(string $name)
    {
        return constant("self::$name");
    }
}
