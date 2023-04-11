<?php

namespace App\Http\Repository;

use App\Http\Factory\Model\Create\CryptoEntriesCreateFactory;
use App\Http\Factory\Model\Update\CryptoEntriesUpdateFactory;
use App\Http\Interface\ModelCreateFactoryInterface;
use App\Http\Interface\ModelUpdateFactoryInterface;
use App\Models\CryptoEntriesActif;

class CryptoEntriesActifRepository extends AbstractBaseRepository
{
    public function getModel(): string
    {
        return CryptoEntriesActif::class;
    }

    public function __construct()
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
