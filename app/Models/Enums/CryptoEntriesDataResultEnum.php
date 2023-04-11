<?php

namespace App\Models\Enums;

enum CryptoEntriesDataResultEnum: string
{
    use EnumToArray;

    case win = 'Gagné';
    case loose = 'Perdu';
    case be = 'Be';
}
