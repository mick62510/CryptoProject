<?php

namespace App\Models;

use App\Models\Enums\CryptoEntriesAnalyzeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoEntriesAnalyze extends Model
{
    use HasFactory;

    protected $table = 'crypto_entries_analyze';
    const CASTS = [
        'double_bot' => CryptoEntriesAnalyzeEnum::class,
        'double_top' => CryptoEntriesAnalyzeEnum::class,
        'divergence' => CryptoEntriesAnalyzeEnum::class,
        'bulle' => CryptoEntriesAnalyzeEnum::class,
    ];
    protected $fillable = ['double_bot', 'double_top', 'divergence', 'bulle'];
}
