<?php

namespace App\Models\Enums;

enum CryptoEntriesDataResultEnum: string
{
    use EnumToArray;

    case win = 'Win';
    case loose = 'Lose';
    case be = 'Be';
}
