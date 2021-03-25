<?php

use App\Http\Controllers\ConfigsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamiliaControler;
use App\Http\Controllers\DashController;
use App\Http\Controllers\ContactController;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', [DashController::class, 'index']);
    Route::get('/familia', [FamiliaControler::class, 'index']);
    Route::get('/excel_familia', [FamiliaControler::class, 'excel']);
    Route::get('/contatos', [ContactController::class, 'index']);
    Route::get('/sincronizar', [ContactController::class, 'sincronizar']);
    Route::get('/dados', [ContactController::class, 'dados']);
    Route::get('/contatos/notify', [ContactController::class, 'notify']);
    Route::get('/contatos/{id}', [ContactController::class, 'contactProfle']);
    Route::get('/contatos/avatar/{id}/{number}', [ContactController::class, 'avatar']);
    Route::get('/whats/user', [ConfigsController::class, 'whatsuser']);
    Route::get('/whats/api', [ConfigsController::class, 'whatsapi']);
    Route::get('/imagem/{sessao}/{numero}', [DashController::class, 'foto']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
