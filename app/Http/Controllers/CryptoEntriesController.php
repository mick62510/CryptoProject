<?php

namespace App\Http\Controllers;

use App\Http\Requests\CryptoEntriesFormFileRequest;
use App\Http\Requests\CryptoEntriesRequest;
use App\Http\Service\CryptoEntriesService;
use App\Http\Service\Grid\GridService;
use App\Http\Service\Grid\Transform\CryptoEntriesNotValidated;
use App\Models\CryptoEntries;
use App\Models\CryptoEntriesActif;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CryptoEntriesController extends AbstractGridController
{
    const VIEW_GRID = 'crypto-entries.index';

    public function __construct(GridService $gridService, private readonly CryptoEntriesService $service)
    {
        parent::__construct($gridService);
    }

    public function getModel(): string
    {
        return CryptoEntries::class;
    }

    public function getDataTransform(): string
    {
        return CryptoEntriesNotValidated::class;
    }

    public function getConfigGrid(): array
    {
        return [
            'where' => [
                [
                    'field' => 'result',
                    'value' => 'null',
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
                'trend' => [
                    'field' => 'trend',
                    'label' => 'Type',
                ],
                'trend_type' => [
                    'field' => 'trend_type',
                    'label' => 'Tendance',
                ],
                'actif_code' => [
                    'model' => 'actif',
                    'field' => 'title',
                    'label' => 'Actif',
                ],
                'risk_reward' => [
                    'field' => 'risk_reward',
                    'label' => 'Risque-récompense',
                ],
                'actions' => [
                    'delete' => [
                        'label' => '<a href="%s" class="btn btn-danger btn-confirmation"><i class="material-icons">delete</i></a>',
                        'route' => 'crypto.entries.delete',
                        'params' => [
                            'column' => 'id',
                        ],
                    ],
                    'show' => [
                        'label' => '<a href="%s" class="btn btn-primary"><i class="material-icons">zoom_in</i></a>',
                        'route' => 'crypto.entries.show',
                        'params' => [
                            'column' => 'id',
                        ],
                    ],
                    'edit' => [
                        'label' => '<a href="%s" class="btn btn-secondary"><i class="material-icons">settings</i></a>',
                        'route' => 'crypto.entries.edit',
                        'params' => [
                            'column' => 'id',
                        ],
                    ],
                    'valide' => [
                        'label' => '<a href="%s" class="btn btn-success"><i class="material-icons">task_alt</i></a>',
                        'route' => 'crypto.entries.valide.update', //TODO
                        'params' => [
                            'column' => 'id',
                        ],
                    ],
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
            ],
        ];
    }

    public function create(): View
    {
        $castsValues = $this->service->getCastsValues();

        return view('crypto-entries.create', ['model' => $this->service->newModel(), 'casts' => $castsValues]);
    }

    public function store(CryptoEntriesRequest $request)
    {
        $this->service->create($request->validationData());

        return to_route('crypto.entries.index');
    }

    public function show()
    {

    }

    public function edit(int $id): View
    {
        $castsValues = $this->service->getCastsValues();

        return view('crypto-entries.edit', ['model' => $this->service->find($id), 'casts' => $castsValues]);
    }

    public function update(CryptoEntriesRequest $request)
    {
        $this->service->update($request->validationData());

        return to_route('crypto.entries.index');
    }

    //TODO transform to method put in vuejs
    public function delete(int $cryptoEntriesId): RedirectResponse
    {
        $this->service->delete($cryptoEntriesId);

        return back();
    }

    public function ajaxUpload(CryptoEntriesFormFileRequest $request): JsonResponse
    {
        $image = $this->service->uploadFile($request->file('file'));
        $preview = asset('storage/' . $image);

        return response()->json([$request->messages(), 'file' => $image, 'preview' => $preview, 'fileName' => $request->file('file')->getClientOriginalName()]);
    }
}
