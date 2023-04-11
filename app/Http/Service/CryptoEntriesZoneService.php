<?php

namespace App\Http\Service;

use App\Http\Repository\CryptoEntriesZoneRepository;

class CryptoEntriesZoneService
{
    public function __construct(private readonly CryptoEntriesZoneRepository $repository)
    {
    }

}
