<?php

namespace App\Models;

use App\Models\Enums\CryptoEntriesOprEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoEntriesOpr extends Model
{
    use HasFactory;

    const CASTS = [
        'bullish_breakout' => CryptoEntriesOprEnum::class,
        'bearish_breakout' => CryptoEntriesOprEnum::class,
        'integration' => CryptoEntriesOprEnum::class,
    ];
    protected $fillable = ['bullish_breakout', 'bearish_breakout', 'integration'];
    protected $table = 'crypto_entries_opr';

}
