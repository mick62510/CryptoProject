<?php

namespace App\Http\Repository\trait;

use App\Models\CryptoEntriesData;

trait CastTrait
{
    public function getCastsValues(): array
    {
        $return = [];
        $casts = $this->new()::CASTS ?: [];

        foreach ($casts as $id => $cast) {
            if (class_exists($cast)) {
                $return[$id] = $cast::array();
            }
        }

        return $return;
    }
}
