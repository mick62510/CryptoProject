<?php

namespace App\Http\Service;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class DashboardCacheService
{
    const ID = 'dashboard_filters';

    public function createUpdate(array $filters = []): void
    {
        $expiration = Carbon::now()->addHour(1);
        Cache::put(self::ID, $filters, $expiration);
    }

    public function get()
    {
        return Cache::get(self::ID);
    }
}
