<?php

namespace App\Models\Enums;

enum CryptoEntriesAnalyzeEnum: string
{
    use EnumToArray;

    case d = 'd';
    case h4 = 'h4';
    case h1 = 'h1';
    case m30 = 'm30';
    case m15 = 'm15';
    case m5 = 'm5';
}
