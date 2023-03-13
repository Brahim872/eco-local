<?php

use App\Http\Controllers\Api\ApiUserController;
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


//Route::get('get_user',[ApiUserController::class,'index'])
//    ->middleware('auth');


Route::get('data-backend',[ApiUserController::class,'index'])->name('api:user.index');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
