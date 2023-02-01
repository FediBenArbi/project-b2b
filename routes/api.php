<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
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
// Route::resource('services' , ServiceController::class);
Route::get('get', [ServiceController::class , 'index']);
Route::post('create', [ServiceController::class , 'store']);
Route::put('update', [ServiceController::class , 'update']);
Route::delete('delete/{id}', [ServiceController::class , 'destroy']);
Route::post('import', [ServiceController::class , 'import']);
Route::get('export', [ServiceController::class , 'export']);


