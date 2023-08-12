<?php

namespace App\Http\Service;

use App\Http\Repository\CryptoEntriesActifAdvancedRepository;
use Illuminate\Support\Facades\Auth;

class CryptoEntriesActifAdvancedService
{

    public function __construct(private readonly CryptoEntriesActifAdvancedRepository $repository)
    {
    }

    public function getRepository(): CryptoEntriesActifAdvancedRepository
    {
        return $this->repository;
    }

    public function regroupByActifCode(): array
    {
        $entries = $this->getRepository()->findByUserId(Auth::user()->getAuthIdentifier());
        $dataByActifCode = ['forex' => [], 'crypto' => []];

        foreach ($entries as $entry) {
            $actifCode = $entry->actif_code;

            if (!isset($dataByActifCode[$actifCode])) {
                $dataByActifCode[$actifCode] = [];
            }

            $dataByActifCode[$actifCode][$entry->value] = $entry->value;
        }

        return $dataByActifCode;
    }
}
