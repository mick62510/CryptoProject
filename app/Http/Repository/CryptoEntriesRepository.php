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

    public function getAllGroupByActifFilterUserId(?int $userId = null, array $actifs = []): array
    {
        $data = [];
        if ($actifs) {
            $modelActifs = CryptoEntriesActif::whereIn('code', $actifs)->get();
        } else {
            $modelActifs = CryptoEntriesActif::all();
        }

        /** @var CryptoEntriesActif $cryptoActif */
        foreach ($modelActifs as $cryptoActif) {
            $data['title'][] = $cryptoActif->title;
            $data['win'][] = CryptoEntries::where('user_id', '=', $userId)->where('actif_code', '=', $cryptoActif->code)->where('result', '=', 'win')->count();
            $data['loose'][] = CryptoEntries::where('user_id', '=', $userId)->where('actif_code', '=', $cryptoActif->code)->where('result', '=', 'loose')->count();
        }
        return $data;
    }


    public function getWinLooseBe(?int $userId = null, array $actifs = []): Collection
    {
        $db = DB::table('crypto_entries')->select(['result', DB::raw('count(result) as total')]);

        if ($actifs) {
            $db->whereIn('actif_code', $actifs);
        }

        return $db->groupBy('result')->get();
    }

    public function getMinHeightMediumRiskReward(?int $userId = null, array $actifs = []): array
    {
        $qb = DB::table('crypto_entries');

        if ($userId) {
            $qb->where('user_id', '=', $userId);
        }

        if ($actifs) {
            $qb->whereIn('actif_code', $actifs);
        }

        return ['max' => $qb->max('risk_reward'), 'min' => $qb->min('risk_reward'), 'median' => number_format($qb->average('risk_reward'), 2)];
    }

    public function getNumberEntries(?int $userId = null, ?string $result = null, array $actifs = []): Collection
    {
        $qb = DB::table('crypto_entries')->select(DB::raw("count(id) as count_total"), DB::raw("(DATE_FORMAT(created_at, '%m')) as month"))
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
            ->whereYear('created_at', '=', now()->year);

        if ($actifs) {
            $qb->whereIn('actif_code', $actifs);
        }

        if (is_null($result)) {
            $qb->whereNotNull('result');
        } else {
            $qb->where('result', '=', $result);
        }


        if ($userId) {
            $qb->where('user_id', '=', $userId);
        }

        return $qb->pluck('count_total', 'month');

    }
}
