<?php

namespace App\Http\Service;

use App\Http\Repository\CryptoEntriesActifRepository;
use App\Models\CryptoEntriesActif;
use Illuminate\Support\Facades\Auth;

class CryptoEntriesActifService
{
    public function __construct(private readonly CryptoEntriesActifRepository $repository)
    {
    }

    public function all()
    {
        return $this->repository->getAll();
    }

    public function allToArray(): array
    {
        $data = [];
        /** @var CryptoEntriesActif $actif */
        foreach ($this->all() as $actif) {
            $data[$actif->code] = $actif->title;
        }

        return $data;
    }

    public function getAllToSelect(): array
    {
        $return = [];
        /** @var CryptoEntriesActif $actif */
        foreach ($this->all() as $actif) {
            $return[] = [
                'value' => $actif->code,
                'label' => $actif->title,
            ];
        }
        return $return;
    }

}
