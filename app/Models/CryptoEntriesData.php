<?php

namespace App\Models;

use App\Models\Enums\CryptoEntriesDataResultEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CryptoEntriesData extends Model
{
    use HasFactory;

    const ID_CAST_RESULT = 'result';

    const CASTS = [
        self::ID_CAST_RESULT => CryptoEntriesDataResultEnum::class,
    ];


    protected $table = 'crypto_entries_data';
    protected $fillable = ['text_before_result', 'image_before_result', 'text_after_result', 'image_after_result'];

    public function entries(): HasMany
    {
        return $this->hasMany(CryptoEntries::class);
    }
}
