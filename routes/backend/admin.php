<?php


use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContacteController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;




    Route::group([
        'prefix' => 'permission',
    ], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('create', [PermissionController::class, 'create'])->name('permission.create');
        Route::post('store', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('show/{id}', [PermissionController::class, 'show'])->name('permission.show');
        Route::delete('destroy/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');
        Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::put('update/{id}', [PermissionController::class, 'update'])->name('permission.update');
    });


    Route::group([
        'prefix' => 'user',
    ], function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/', [UserController::class, 'index'])->name('user.index.post');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('show/{id}', [UserController::class, 'show'])->name('user.show');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('update/{id}', [UserController::class, 'updateUser'])->name('user.update');
        Route::post('updatePassword/{id}', [UserController::class, 'updatePassword'])->name('user.update.password');
        Route::get('edit-account-info', [UserController::class, 'accountInfo'])->name('backend.account.info');
        Route::post('edit-account-info', [UserController::class, 'accountInfoStore'])->name('backend.account.info.store');
        Route::post('change-password', [UserController::class, 'changePasswordStore'])->name('backend.account.password.store');
    });


    Route::group([
        'prefix' => 'role',
    ], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('create', [RoleController::class, 'create'])->name('role.create');
        Route::post('store', [RoleController::class, 'store'])->name('role.store');
        Route::get('show/{id}', [RoleController::class, 'show'])->name('role.show');
        Route::delete('destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('update/{id}', [RoleController::class, 'update'])->name('role.update');

    });






