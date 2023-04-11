<?php

namespace App\Models\Enums;

enum CryptoEntriesOprEnum: string
{
    use EnumToArray;

    case m5 = 'm5';
    case m15 = 'm15';
}
