<?php

namespace App\Http\Controllers;

use App\Models\CryptoEntries;
use App\Models\CryptoEntriesAnalyze;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{

    public function index(): View
    {
        return view('home');
    }

}
