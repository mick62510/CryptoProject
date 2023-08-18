<?php

namespace App\Http\Factory\Model\Update;

use App\Http\Factory\Model\Create\CryptoEntriesCreateDataFactory;
use App\Http\Interface\ModelUpdateFactoryInterface;
use App\Models\CryptoEntries;
use Illuminate\Database\Eloquent\Model;

class CryptoEntriesUpdateFactory implements ModelUpdateFactoryInterface
{

    public function __construct(private readonly CryptoEntriesCreateDataFactory $createDataFactory)
    {
    }

    public function update(Model $model, mixed $data): Model
    {
        if (array_key_exists('image_before_result', (array)$data)) {
            /** @var CryptoEntries $model */
            if ($modelData = $model->data()?->first()) {
                if ($img = $modelData->image_before_result) {
                    if ($data['image_before_result'] && $img != $data['image_before_result']) {
                        $data['image_before_result'] = $this->createDataFactory->moveFileAndGetFileName((array)$data, 'image_before_result', 'before_');
                    } else {
                        $data['image_before_result'] = $img;
                    }
                }
            }
        }

        if (array_key_exists('image_after_result', (array)$data)) {
            $data['image_after_result'] = $this->createDataFactory->moveFileAndGetFileName((array)$data, 'image_after_result', 'after_');
        }

        if(array_key_exists('risk_reward_valid',(array)$data)){
            $model->risk_reward_valid = $data['risk_reward_valid'];
        }

        $model->fill($data);
        $model->analyze()->first()->fill((array)$data)->save();
        $model->data()->first()->fill((array)$data)->save();
        $model->opr()->first()->fill((array)$data)->save();
        $model->zone()->first()->fill((array)$data)->save();


        return $model;
    }

}
