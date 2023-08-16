<?php

use App\Http\Controllers\CryptoEntriesController;
use App\Http\Controllers\CryptoEntriesValideController;
use App\Http\Middleware\CryptoEntriesNotValidated;
use Illuminate\Support\Facades\Route;

Route::name('entries.')->prefix('entries')->controller(CryptoEntriesController::class)->group(function () {
    Route::get('/list-not-validated', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/store', 'store')->name('store');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}','delete')->name('delete');
    Route::post('/upload-file', 'ajaxUpload')->name('ajax-upload');
    Route::get('/ajax-grid-data', 'ajaxGridData')->name('ajaxGridData');
    Route::get('/{id}', 'show')->name('show');

    Route::name('valide.')->prefix('valide')->controller(CryptoEntriesValideController::class)->group(function () {
        Route::get('/list-validated', 'index')->name('index');
        Route::get('/update/{id}', 'update')->name('update')->middleware(CryptoEntriesNotValidated::class);
        Route::post('/store/{id}', 'store')->name('store');
        Route::get('/delete/{id}','delete')->name('delete');
        Route::post('/upload-file', 'ajaxUpload')->name('ajax-upload');
        Route::get('/ajax-grid-data', 'ajaxGridData')->name('ajaxGridData');
        Route::get('/{id}', 'show')->name('show');
    });

});
