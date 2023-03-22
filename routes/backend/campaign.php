<?php

use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'campaign',
    'as'=>'campaign.'
], function () {
    Route::match(['get','post'],'/', [CampaignController::class, 'index'])
        ->name('index');

    Route::get('create', [CampaignController::class, 'create'])
        ->name('create');

    Route::post('store', [CampaignController::class, 'store'])
        ->name('store');

    Route::get('show/{id}', [CampaignController::class, 'show'])
        ->name('show');

    Route::delete('destroy/{id}', [CampaignController::class, 'destroy'])
        ->name('destroy');

    Route::get('edit/{slug}', [CampaignController::class, 'edit'])
        ->name('edit');

    Route::put('update/{id}', [CampaignController::class, 'update'])
        ->name('update');

});
