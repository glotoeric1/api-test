<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/index', [TestController::class, 'index'])->name('afficher');
Route::get('/show/{id}', [TestController::class, 'show'])->name('showparId');
Route::post('/store', [TestController::class, 'store'])->name('ajouter');
Route::post('/update/{id}', [TestController::class, 'update'])->name('modifier');
Route::post('/delete/{id}', [TestController::class, 'destroy'])->name('supprimer');


/*
Tu peux aussi utiliser ApiResource */
//Route::ApiResource('/test', 'App\Http\Controllers\TestController');

