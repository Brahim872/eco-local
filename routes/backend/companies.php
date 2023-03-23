<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'company',
], function () {
    Route::match(['get','post'],'/', [CompanyController::class, 'index'])
        ->name('company.index');

    Route::post('/', [CompanyController::class, 'index'])
        ->name('company.index.post');

    Route::get('create', [CompanyController::class, 'create'])
        ->name('company.create');

    Route::post('store', [CompanyController::class, 'store'])
        ->name('company.store');

    Route::get('show/{id}', [CompanyController::class, 'show'])
        ->name('company.show');

    Route::delete('destroy/{id}', [CompanyController::class, 'destroy'])
        ->name('company.destroy');

    Route::get('edit/{slug}', [CompanyController::class, 'edit'])
        ->name('company.edit');

    Route::post('update/{id}', [CompanyController::class, 'update'])
        ->name('company.update');

});
