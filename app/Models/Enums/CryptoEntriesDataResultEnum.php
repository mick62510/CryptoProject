<?php

namespace App\Models\Enums;

enum CryptoEntriesDataResultEnum: string
{
    use EnumToArray;

    case win = 'Win';
    case loose = 'Loose';
    case be = 'Be';
}
