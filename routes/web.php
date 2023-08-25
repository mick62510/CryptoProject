<?php


use App\Http\Controllers\CookieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('home');
Route::get('cookie-policy', [CookieController::class, 'index'])->name('cookie-policy.index');
Route::middleware('auth')->group(function () {
    Route::name('crypto.')->prefix('crypto')->group(function () {
        include 'web/crypto-entries.php';
        include 'web/crypto-ajax.php';
    });

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile-destroy', [ProfileController::class, 'deleteAccount'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
