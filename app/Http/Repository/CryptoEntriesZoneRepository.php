<?php

namespace App\Http\Repository;

use App\Http\Factory\Model\Create\CryptoEntriesCreateZoneFactory;
use App\Http\Factory\Model\Update\CryptoEntriesZoneUpdateFactory;
use App\Http\Interface\ModelCreateFactoryInterface;
use App\Http\Interface\ModelUpdateFactoryInterface;
use App\Models\CryptoEntriesZone;

class CryptoEntriesZoneRepository extends AbstractBaseRepository
{
    public function getModel(): string
    {
        return CryptoEntriesZone::class;
    }

    public function __construct(
        private readonly CryptoEntriesCreateZoneFactory $createFactory,
        private readonly CryptoEntriesZoneUpdateFactory $updateFactory,
    )
    {
        parent::__construct();
    }

    public function getModelCreateFactory(): ModelCreateFactoryInterface
    {
        return $this->createFactory;
    }

    public function getModelUpdateFactory(): ModelUpdateFactoryInterface
    {
        return $this->updateFactory;
    }
}
