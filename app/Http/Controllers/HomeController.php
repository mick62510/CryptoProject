<?php

namespace App\Http\Controllers;

use App\Http\Service\DashboardCacheService;
use App\Models\CryptoEntries;
use App\Models\CryptoEntriesAnalyze;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{

    public function __construct(private readonly DashboardCacheService $cacheService)
    {
    }

    public function index(): View
    {
        return view('home', ['filters' => $this->cacheService->get()]);
    }

}
