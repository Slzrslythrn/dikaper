<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/inacbgs', [App\Http\Controllers\JamkesdaController::class, 'ajaxInacbgs'])->name('api.ajax.inacbgs');
Route::post('/diagnosa', [App\Http\Controllers\JamkesdaController::class, 'ajaxDiagnosa'])->name('api.ajax.diagnosa');
Route::post('/by_nik', [App\Http\Controllers\JamkesdaController::class, 'byNik']);
