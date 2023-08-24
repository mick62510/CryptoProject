<?php

namespace App\Http\Repository;

use App\Http\Factory\Model\Create\CryptoEntriesCreateFactory;
use App\Http\Factory\Model\Update\CryptoEntriesUpdateFactory;
use App\Http\Interface\ModelCreateFactoryInterface;
use App\Http\Interface\ModelUpdateFactoryInterface;
use App\Http\Repository\trait\CastTrait;
use App\Models\CryptoEntries;
use App\Models\CryptoEntriesActif;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CryptoEntriesRepository extends AbstractBaseRepository
{
    use CastTrait;

    public function getModel(): string
    {
        return CryptoEntries::class;
    }

    public function __construct(
        private readonly CryptoEntriesCreateFactory $createFactory,
        private readonly CryptoEntriesUpdateFactory $updateFactory,
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

    public function getAllByResult(?string $result = null)
    {
        return CryptoEntries::where('result', '=', $result)->paginate(10);
    }

    public function getAllByFilters(?int $userId = null, array $filters = []): array
    {
        $actifs = array_key_exists('actif', $filters) ? $filters['actif'] : [];
        $data = [];

        if ($actifs) {
            $modelActifs = CryptoEntriesActif::whereIn('code', $actifs)->get();
        } else {
            $modelActifs = CryptoEntriesActif::all();
        }

        /** @var CryptoEntriesActif $cryptoActif */
        foreach ($modelActifs as $cryptoActif) {
            $builderWin = CryptoEntries::where('user_id', $userId)->where('actif_code', $cryptoActif->code)->where('result', 'win');
            $builderWin = $this->queryBuilderAddDate($builderWin, $filters);

            $builderLose = CryptoEntries::where('user_id', $userId)->where('actif_code', $cryptoActif->code)->where('result', 'loose');
            $builderLose = $this->queryBuilderAddDate($builderLose, $filters);

            $data['title'][] = $cryptoActif->title;
            $data['win'][] = $builderWin->count();
            $data['loose'][] = $builderLose->count();
        }

        return $data;
    }

    private function queryBuilderAddDate(\Illuminate\Database\Eloquent\Builder $builder, array $filters): \Illuminate\Database\Eloquent\Builder
    {
        if (array_key_exists('date', $filters)) {
            $filterDate = $filters['date'];

            $type = $filterDate['type'];
            $value = $filterDate['value'];

            if ($type === 'year') {
                $builder->whereYear('created_at', $value);
            } elseif ($type === 'between') {
                $builder->whereBetween('created_at', [$value[0], $value[1]]);
            } elseif ($type === 'month') {
                $builder->whereYear('created_at', $value['year'])
                    ->whereMonth('created_at', $value['month'] + 1);

            }
        }
        return $builder;
    }


    public function getWinLooseBe(?int $userId = null, array $actifs = [], bool $activeBe = true, array $filters = []): Collection
    {
        $db = CryptoEntries::query()->select(['result', DB::raw('count(result) as total')]);
        $db->where('user_id', '=', $userId);
        $db->whereNotNull('result');
        $db = $this->queryBuilderAddDate($db, $filters);

        if (!$activeBe) {
            $db->where('result', '<>', 'be');
        }

        if ($actifs) {
            $db->whereIn('actif_code', $actifs);
        }

        return $db->groupBy('result')->get();
    }

    public function getMinHeightMediumRiskReward(?int $userId = null, array $actifs = [], bool $activeBe = true, bool $valid = false): array
    {
        $qb = DB::table('crypto_entries');

        if ($userId) {
            $qb->where('user_id', '=', $userId);
        }
        if (!$activeBe) {
            $qb->where('result', '<>', 'be');
        }

        if ($actifs) {
            $qb->whereIn('actif_code', $actifs);
        }
        if ($valid) {
            $max = $qb->max('risk_reward_valid');
            $min = $qb->min('risk_reward_valid');
            $qb2 = $qb;

            if($activeBe) {
                $total = $qb2->where('result','<>','be')->count();
            } else {
                $total = $qb2->count();
            }

            $nbWin = $qb->where('result','win')->count();

            return ['max' => $max, 'min' => $min, 'median' => number_format(($nbWin / $total) * 100, 2,',').'%'];
        } else {
            return ['max' => $qb->max('risk_reward'), 'min' => $qb->min('risk_reward'), 'median' => number_format($qb->average('risk_reward'), 2)];
        }
    }

    public function getNumberEntries(?int $userId = null, ?string $result = null, array $actifs = [], array $filters = [],$activeBe = true): Collection
    {
        $qb = CryptoEntries::query()
            ->orderBy('created_at');


        if ($actifs) {
            $qb->whereIn('actif_code', $actifs);
        }

        if (is_null($result)) {
            if($activeBe) {
                $qb->whereNotNull('result');
            }else {
                $qb->whereNotNull('result')->where('result','<>','be');
            }

        } else {
            $qb->where('result', '=', $result);
        }

        if ($userId) {
            $qb->where('user_id', '=', $userId);
        }

        $qb = $this->queryBuilderAddDate($qb, $filters);

        if (array_key_exists('date', $filters)) {
            $type = $filters['date']['type'];
            if ($type === 'year') {
                $qb->select(DB::raw("count(id) as count_total"), DB::raw("(DATE_FORMAT(created_at, '%m')) as month"))->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"));
            } else if ($type === 'month') {
                $qb->select(DB::raw("count(id) as count_total"), DB::raw("(DATE_FORMAT(created_at, '%d')) as month"))->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"));
            } else if ($type === 'between') {
                $qb->select(DB::raw("count(id) as count_total"), DB::raw("(DATE_FORMAT(created_at, '%m%d')) as month"))->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"));
            }
        }

        return $qb->pluck('count_total', 'month');

    }
}
