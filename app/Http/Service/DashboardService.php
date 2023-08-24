<?php

namespace App\Http\Service;

class DashboardService
{
    public function getYears(): array
    {
        $now = (int)now()->format('Y');

        return ['now' => $now, 'available' => [$now - 2, $now - 1, $now,]];
    }
}
