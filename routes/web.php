<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\PriceController;


Route::get('/', [HomePageController::class, 'show'])->name('showindex');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('company', CompanyController::class);
    Route::resource('position', PositionController::class);


    Route::prefix('admin')->group(function () {
        Route::get('/reset-password/{id}', [UserController::class, 'resetPassword'])->name('resetpassword');
        Route::get('/order', [OrderController::class, 'index'])->name('user.order.index');
    });

    //Юзерские
    Route::prefix('user')->group(function () {
        Route::get('/order-create', [OrderController::class, 'create'])->name('user.order.index');
        Route::get('/order-pay', [OrderController::class, 'pay'])->name('user.order.pay');
        Route::POST('/order-store', [OrderController::class, 'store'])->name('user.order.store');
        Route::get('/order-new', [OrderController::class, 'news'])->name('user.orders.new');
        Route::get('/order-show/{id}', [OrderController::class, 'show'])->name('user.order.show');
        Route::get('/order-history', [OrderController::class, 'history'])->name('user.order.history');


        Route::get('/edit', [UserController::class, 'userEdit'])->name('user.edit');
        Route::post('/edit/{id}', [UserController::class, 'userChange'])->name('user.change');
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('user.changepass');
        Route::post('/edit-password', [UserController::class, 'editUserPassword'])->name('user.editpass');

    });

    //Компания
    Route::prefix('transport')->group(function () {
        Route::get('/warehouse-create', [WarehouseController::class, 'create'])->name('company.warehouse.create');
        Route::POST('/warehouse-store', [WarehouseController::class, 'store'])->name('company.warehouse.store');
        Route::get('/warehouses', [WarehouseController::class, 'index'])->name('company.warehouse.index');

        Route::get('/order', [OrderController::class, 'transportNews'])->name('transport.orders.new');
        Route::get('/order-history', [OrderController::class, 'transportHistory'])->name('transport.order.history');
    });

    //Прайсы
    Route::prefix('price')->group(function () {
        Route::get('/add', [PriceController::class, 'create'])->name('company.price.create');
        Route::POST('/store', [PriceController::class, 'store'])->name('company.price.store');
        Route::get('/show', [PriceController::class, 'index'])->name('company.price.index');
        Route::get('/delete/{id}', [PriceController::class, 'delete'])->name('company.price.delete');

    });
    //Подтверждение и загрузка
    Route::prefix('approve')->group(function () {
        Route::POST('/score/{id}', [OrderController::class, 'approve'])->name('approvescore');
        Route::POST('/payment/{id}', [OrderController::class, 'approve'])->name('approvepayment');
        Route::POST('/courier-from/{id}', [OrderController::class, 'approve'])->name('approvecourierfrom');
        Route::POST('/warehous-from/{id}', [OrderController::class, 'approve'])->name('approvewarehousfrom');
        Route::POST('/warehous-to/{id}', [OrderController::class, 'approve'])->name('approvewarehousto');
        Route::POST('/drive/{id}', [OrderController::class, 'approve'])->name('approvetodrive');
        Route::POST('/courier-to/{id}', [OrderController::class, 'approve'])->name('approvecourier_to');
        Route::POST('/customs/{id}', [OrderController::class, 'approve'])->name('approvecustoms');
        Route::POST('/received/{id}', [OrderController::class, 'approve'])->name('approvereceived');
    });

    //Searches
    Route::get('/users-search/', [UserController::class, 'search'])->name('usersearch');
    Route::get('/position-search/', [PositionController::class, 'search'])->name('positionsearch');
    Route::get('/company-search/', [CompanyController::class, 'search'])->name('companysearch');

    //AJAX
    Route::group(['middleware' => ['auth']], function () {
        Route::GET('/get-cities-by-country/{id}', [CityController::class, 'getCitiesByCountry']);
        Route::GET('/get-all-addresses/{id}', [AddressController::class, 'getAllAddresses']);

    });



    //Оптимизация сервера на бою
    Route::get('/optimize', function() { $exitCode = Artisan::call('optimize');var_dump('optimized');});
});


