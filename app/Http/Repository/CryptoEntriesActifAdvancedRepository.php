<?php

namespace App\Http\Repository;

use App\Models\CryptoEntriesActifAdvanced;
use Illuminate\Support\Collection;

class CryptoEntriesActifAdvancedRepository
{
    public function findByUserIdAndActifCodeAndValue(int $userId, string $actifCode, string $value): ?CryptoEntriesActifAdvanced
    {
        return CryptoEntriesActifAdvanced::where('user_id','=',$userId)->where('actif_code','=',$actifCode)->where('value','=',$value)->first();
    }

    public function findByUserId(int $userId): Collection
    {
        return CryptoEntriesActifAdvanced::where('user_id','=',$userId)->get();
    }
}
