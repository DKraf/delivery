<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AssigenTestController;
use App\Http\Controllers\TestTypeController;
use App\Http\Controllers\TestThemeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\WarehouseController;


Route::get('/', [HomePageController::class, 'show'])->name('showindex');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('test', TestController::class);
    Route::resource('company', CompanyController::class);
    Route::resource('position', PositionController::class);
    Route::resource('test-theme', TestThemeController::class);
    Route::resource('test-type', TestTypeController::class);
    Route::resource('test-assign', AssigenTestController::class);

    Route::prefix('admin')->group(function () {
        Route::get('/testhistory/{id}', [AssigenTestController::class, 'testsHistoryShow'])->name('testhistoryshow');
        Route::get('/refresh-test/{id}', [AssigenTestController::class, 'refreshTest'])->name('refreshtest');
        Route::get('/testhistory', [AssigenTestController::class, 'testsHistory'])->name('testhistory');
        Route::get('/reset-password/{id}', [UserController::class, 'resetPassword'])->name('resetpassword');
        Route::get('/edit-index', [HomePageController::class, 'index'])->name('editindex');
        Route::post('/update-index', [HomePageController::class, 'update'])->name('updateindex');
        Route::get('/order', [OrderController::class, 'index'])->name('user.order.index');

    });

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

    Route::prefix('transport')->group(function () {
        Route::get('/warehouse-create', [WarehouseController::class, 'create'])->name('company.warehouse.create');
        Route::POST('/warehouse-store', [WarehouseController::class, 'store'])->name('company.warehouse.store');
        Route::get('/warehouses', [WarehouseController::class, 'index'])->name('company.warehouse.index');
    });

    Route::get('/optimize', function() { $exitCode = Artisan::call('optimize');var_dump('optimized');});

    Route::get('/test-add/{id}', [TestController::class, 'createCustom'])->name('createCustom');

    Route::get('/download-result/{id}', [ExcelController::class, 'downloadResult'])->name('downloadResult');

    //Searches
    Route::get('/users-search/', [UserController::class, 'search'])->name('usersearch');
    Route::get('/position-search/', [PositionController::class, 'search'])->name('positionsearch');
    Route::get('/company-search/', [CompanyController::class, 'search'])->name('companysearch');
    Route::get('/test-type-search/', [TestTypeController::class, 'search'])->name('testtypesearch');
    Route::get('/test-theme-search/', [TestThemeController::class, 'search'])->name('testthemesearch');
    Route::get('/test-assign-search/', [AssigenTestController::class, 'search'])->name('testassignsearch');
    Route::get('/test-assign-history-search/', [AssigenTestController::class, 'searchhistory'])->name('testassignhistorysearch');

//AJAX
    Route::group(['middleware' => ['auth']], function () {
        Route::GET('/get-cities-by-country/{id}', [CityController::class, 'getCitiesByCountry']);
        Route::GET('/get-all-addresses/{id}', [AddressController::class, 'getAllAddresses']);

    });
});


