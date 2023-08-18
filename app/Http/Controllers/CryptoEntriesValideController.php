<?php

namespace App\Http\Controllers;

use App\Http\Requests\CryptoEntriesFormFileRequest;
use App\Http\Requests\CryptoEntriesValideRequest;
use App\Http\Service\CryptoEntriesValideService;
use App\Http\Service\Grid\GridService;
use App\Http\Service\Grid\Transform\CryptoEntriesNotValidated;
use App\Http\Service\Grid\Transform\CryptoEntriesValidated;
use App\Models\CryptoEntries;
use App\Models\CryptoEntriesActif;
use App\Models\Enums\CryptoEntriesDataResultEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CryptoEntriesValideController extends AbstractGridController
{

    const VIEW_GRID = 'crypto-entries-valide.index';

    public function __construct(GridService $gridService, private readonly CryptoEntriesValideService $service)
    {
        parent::__construct($gridService);
    }

    public function getConfigGrid(): array
    {
        return [
            'orders' => [
                [
                    'field' => 'created_at',
                    'type' => 'DESC'
                ]
            ],
            'where' => [
                [
                    'field' => 'result',
                    'value' => 'not_null',
                ],
                [
                    'field' => 'user_id',
                    'value' => Auth::id(),
                ],
            ],
            'columns' => [
                'id' => [
                    'field' => 'id',
                    'display' => false,
                    'label' => 'ID',
                ],
                'createdAt' => [
                    'field' => 'created_at',
                    'label' => 'Crée le'
                ],
                'result' => [
                    'field' => 'result',
                    'label' => 'Résultat',
                ],
                'trend_type' => [
                    'field' => 'trend_type',
                    'label' => 'Tendance',
                ],
                'trend' => [
                    'field' => 'trend',
                    'label' => 'Type',
                ],
                'actif_code' => [
                    'model' => 'actif',
                    'field' => 'title',
                    'label' => 'Actif',
                ],
                'risk_reward_valid' => [
                    'field' => 'risk_reward_valid',
                    'label' => 'RR Validé',
                ],
                'actions' => [
                    'delete' => [
                        'label' => '<a href="%s" class="btn btn-danger btn-confirmation"><i class="material-icons">delete</i></a>',
                        'route' => 'crypto.entries.delete',
                        'params' => [
                            'column' => 'id',
                        ],
                    ],
                    /**'show' => [
                        'label' => '<a href="%s" class="btn btn-primary"><i class="material-icons">zoom_in</i></a>',
                        'route' => 'crypto.entries.valide.show',
                        'params' => [
                            'column' => 'id',
                        ],
                    ],**/
                ],
            ],
            'extra' => [
                [
                    'label' => 'OPR',
                    'columns' => [
                        'bullish_breakout' => [
                            'model' => 'opr',
                            'field' => 'bullish_breakout',
                            'label' => 'Bullish breakout',
                        ],
                        'bearish_breakout' => [
                            'model' => 'opr',
                            'field' => 'bearish_breakout',
                            'label' => 'Bearish breakout',
                        ],
                        'integration' => [
                            'model' => 'opr',
                            'field' => 'integration',
                            'label' => 'Intégration',
                        ],
                    ],
                ],
                [
                    'label' => 'Actif avancée',
                    'columns' => [
                        'actif_code' => [
                            'model' => 'actifAdvanced',
                            'field' => 'actif_code',
                            'label' => 'Actif',
                        ],
                        'value' => [
                            'model' => 'actifAdvanced',
                            'field' => 'value',
                            'label' => 'Valeur',
                        ],
                    ],
                ],
                [
                    'label' => 'Zone',
                    'columns' => [
                        'area_d' => [
                            'model' => 'zone',
                            'field' => 'area_d',
                            'label' => 'Zone D',
                        ],
                        'area_h4' => [
                            'model' => 'zone',
                            'field' => 'area_h4',
                            'label' => 'Zone h4',
                        ],
                        'area_h1' => [
                            'model' => 'zone',
                            'field' => 'area_h1',
                            'label' => 'Zone H1',
                        ],
                        'area_m30' => [
                            'model' => 'zone',
                            'field' => 'area_m30',
                            'label' => 'Zone M30',
                        ],
                    ],
                ],
                [
                    'label' => 'Analyze',
                    'columns' => [
                        'double_bot' => [
                            'model' => 'analyze',
                            'field' => 'double_bot',
                            'label' => 'Double Bot',
                        ],
                        'double_top' => [
                            'model' => 'analyze',
                            'field' => 'double_top',
                            'label' => 'Double Top',
                        ],
                        'divergence' => [
                            'model' => 'analyze',
                            'field' => 'divergence',
                            'label' => 'Divergence',
                        ],
                        'bulle' => [
                            'model' => 'analyze',
                            'field' => 'bulle',
                            'label' => 'Bulle',
                        ],
                    ],
                ],
                [
                    'label' => 'Données avant résultat',
                    'columns' => [
                        'text_before_result' => [
                            'model' => 'data',
                            'field' => 'text_before_result',
                            'label' => 'Texte',
                        ],
                        'image_before_result' => [
                            'model' => 'data',
                            'ext' => 'image',
                            'field' => 'image_before_result',
                            'label' => 'Image',
                        ],
                    ],
                ],
                [
                    'label' => 'Données Après résultat',
                    'columns' => [
                        'text_after_result' => [
                            'model' => 'data',
                            'field' => 'text_after_result',
                            'label' => 'Texte',
                        ],
                        'image_after_result' => [
                            'model' => 'data',
                            'ext' => 'image',
                            'field' => 'image_after_result',
                            'label' => 'Image',
                        ],
                    ],
                ],
                [
                    'label' => 'Risque Reward',
                    'columns' => [
                        'risk_reward' => [
                            'field' => 'risk_reward',
                            'label' => 'Objectif',
                        ],
                        'risk_reward_valid' => [
                            'field' => 'risk_reward_valid',
                            'label' => 'Validé',
                        ],
                    ],
                ],
            ],
            'filters' => [
                'actif_code' => [
                    'values' => function (CryptoEntries $model) {
                        $array = [];
                        foreach (CryptoEntriesActif::all() as $item) {
                            $array[$item->code] = $item->title;
                        }

                        return $array;
                    },
                    'model' => 'actif',
                    'type' => 'select',
                    'field' => 'code',
                    'label' => 'Actif Code',
                ],
                'result' => [
                    'values' => CryptoEntriesDataResultEnum::array(),
                    'type' => 'select',
                    'field' => 'result',
                    'label' => 'Résultat',
                ],
            ],
        ];
    }

    public function getModel(): string
    {
        return CryptoEntries::class;
    }

    public function getDataTransform(): string
    {
        return CryptoEntriesValidated::class;
    }

    public function update(int $id): View
    {
        $castsValues = $this->service->getCastsValues();

        return view('crypto-entries-valide.update', ['model' => $this->service->findById($id), 'casts' => $castsValues]);
    }

    public function ajaxUpload(CryptoEntriesFormFileRequest $request): JsonResponse
    {
        $image = $this->service->uploadFile($request->file('file'));
        $preview = asset('storage/' . $image);

        return response()->json([$request->messages(), 'file' => $image, 'preview' => $preview, 'fileName' => $request->file('file')->getClientOriginalName()]);
    }

    public function store(int $id, CryptoEntriesValideRequest $request): RedirectResponse
    {
        $this->service->update($id, $request->validationData());

        return to_route('crypto.entries.valide.index');
    }
    //TODO transform to method put in vuejs
    public function delete(int $cryptoEntriesId): RedirectResponse
    {
        $this->service->delete($cryptoEntriesId);

        return back();
    }
}
