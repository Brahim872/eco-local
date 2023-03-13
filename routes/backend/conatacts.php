<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'contact',
    'as'=>'contact.'
], function () {
    Route::match(['get','post'],'/', [ContactController::class, 'index'])
        ->name('index');



    Route::get('create', [ContactController::class, 'create'])
        ->name('create');

    Route::post('store', [ContactController::class, 'store'])
        ->name('store');

    Route::get('show/{id}', [ContactController::class, 'show'])
        ->name('show');

    Route::delete('destroy/{id}', [ContactController::class, 'destroy'])
        ->name('destroy');

    Route::get('edit/{slug}', [ContactController::class, 'edit'])
        ->name('edit');

    Route::put('update/{id}', [ContactController::class, 'updateCompany'])
        ->name('update');

});
