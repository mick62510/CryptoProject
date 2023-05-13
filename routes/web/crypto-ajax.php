<?php

use App\Http\Controllers\AjaxController\DashBoardController;
use App\Http\Controllers\CryptoEntriesController;
use App\Http\Controllers\CryptoEntriesValideController;
use App\Http\Middleware\CryptoEntriesNotValidated;
use Illuminate\Support\Facades\Route;

Route::name('ajax.')->prefix('ajax')->group(function () {
    Route::name('dashboard.')->prefix('dashboard')->controller(DashBoardController::class)->group(function () {
        Route::get('/dashboard-radar-actif', 'radarActif')->name('radar-actif');
        Route::get('/doughnut-win-loose', 'doughnutWinLoose')->name('doughnut-win-loose');
        Route::get('/ratio-risk-reward', 'ratioRiskReward')->name('ratio-risk-reward');
        Route::get('/line-number-entries', 'lineNumberEntries')->name('line-number-entries');
        Route::get('/data-actif', 'dataActif')->name('data-actif');
        Route::get('/update-cache', 'updateCache')->name('update-cache');
    });
});

