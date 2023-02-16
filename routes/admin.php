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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group([
//    'prefix' => 'admin',
    'middleware' => ['auth'],
], function () {

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
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'storeUser'])->name('user.store');
        Route::get('show/{id}', [UserController::class, 'show'])->name('user.show');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('update/{id}', [UserController::class, 'updateUser'])->name('user.update');
        Route::post('updatePassword/{id}', [UserController::class, 'updatePassword'])->name('user.update.password');
        Route::get('edit-account-info', [UserController::class, 'accountInfo'])->name('admin.account.info');
        Route::post('edit-account-info', [UserController::class, 'accountInfoStore'])->name('admin.account.info.store');
        Route::post('change-password', [UserController::class, 'changePasswordStore'])->name('admin.account.password.store');
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


    Route::group([
        'prefix' => 'contact',
    ], function () {
        Route::get('/', [ContacteController::class, 'index'])->name('contact.index');
        Route::get('create', [ContacteController::class, 'create'])->name('contact.create');
        Route::post('store', [ContacteController::class, 'store'])->name('contact.store');
        Route::get('show/{id}', [ContacteController::class, 'show'])->name('contact.show');
        Route::delete('destroy/{id}', [ContacteController::class, 'destroy'])->name('contact.destroy');
        Route::get('edit/{id}', [ContacteController::class, 'edit'])->name('contact.edit');
        Route::put('update/{id}', [ContacteController::class, 'update'])->name('contact.update');

    });


    Route::group([
        'prefix' => 'campaign',
    ], function () {
        Route::get('/', [CampaignController::class, 'index'])->name('campaign.index');
        Route::get('create', [CampaignController::class, 'create'])->name('campaign.create');
        Route::post('store', [CampaignController::class, 'storeCampaign'])->name('campaign.store');
        Route::get('show/{id}', [CampaignController::class, 'show'])->name('campaign.show');
        Route::delete('destroy/{id}', [CampaignController::class, 'destroy'])->name('campaign.destroy');
        Route::get('edit/{id}', [CampaignController::class, 'edit'])->name('campaign.edit');
        Route::put('update/{id}', [CampaignController::class, 'update'])->name('campaign.update');

    });

    Route::group([
        'prefix' => 'client',
    ], function () {
        Route::get('/', [ClientController::class, 'index'])->name('client.index');
        Route::get('create', [ClientController::class, 'create'])->name('client.create');
        Route::post('store', [ClientController::class, 'storeClient'])->name('client.store');
        Route::get('show/{id}', [ClientController::class, 'show'])->name('client.show');
        Route::delete('destroy/{id}', [ClientController::class, 'destroy'])->name('client.destroy');
        Route::get('edit/{slug}', [ClientController::class, 'edit'])->name('client.edit');
        Route::put('update/{id}', [ClientController::class, 'updateClient'])->name('client.update');
    });

    Route::group([
        'prefix' => 'product',
    ], function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('create', [ProductController::class, 'create'])->name('product.create');
        Route::post('store', [ProductController::class, 'storeProduct'])->name('product.store');
//            Route::get('show/{id}', [ProductController::class,'show'])->name('product.show');
        Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('edit/{slug}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('update/{id}', [ProductController::class, 'updateProduct'])->name('product.update');
    });

    Route::get('switch-status', [ProductController::class, 'switchStatus'])->name('switch.status');






    Route::group([
        'prefix' => 'company',
    ], function () {
        Route::get('/', [CompanyController::class, 'index'])->name('company.index');
        Route::get('create', [CompanyController::class, 'create'])->name('company.create');
        Route::post('store', [CompanyController::class, 'storeCompany'])->name('company.store');
        Route::get('show/{id}', [CompanyController::class, 'show'])->name('company.show');
        Route::delete('destroy/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');
        Route::get('edit/{slug}', [CompanyController::class, 'edit'])->name('company.edit');
        Route::put('update/{id}', [CompanyController::class, 'updateCompany'])->name('company.update');
    });

});
