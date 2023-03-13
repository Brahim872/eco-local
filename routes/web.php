<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::group([
//    'prefix' => 'backend',
    'middleware' => ['auth'],
], function () {

    require __DIR__ . '/admin.php';
    require __DIR__ . '/backend/companies.php';
    require __DIR__ . '/backend/conatacts.php';
});

require __DIR__ . '/auth.php';
