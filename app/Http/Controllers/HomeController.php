<?php

namespace App\Http\Controllers;

use App\Http\Service\DashboardCacheService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{

    public function __construct(private readonly DashboardCacheService $cacheService)
    {
    }

    public function index(Request $request): View
    {
        return view('home', ['filters' => $this->cacheService->get()]);
    }

}
