<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Redirecionar a rota raiz para a dashboard.
Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

/**
 * guest -> Rotas para usuários não autenticados.
 */
Route::middleware(['guest'])->group(function () {
    /* Autenticação */
    Route::get('login', [LoginController::class, 'formLogin'])->name('auth.formLogin');
    Route::post('login', [LoginController::class, 'login'])->name('auth.login');
});

/**
 * auth.web -> Rotas para usuários autenticados.
 */
Route::prefix('dashboard')->middleware(['auth.web'])->group(function () {
    /* Dashboard */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
});
