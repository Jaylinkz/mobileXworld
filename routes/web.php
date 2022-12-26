<?php
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\rateController;
use App\Http\Controllers\adminProdController;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/admin');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('category', categoryController::class);
    Route::resource('orders', OrderController::class);
    Route::post('exchange_rate',[rateController::class,'updateRate'])->name('exchangeRate');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::delete('/cart/delete', [CartController::class, 'delete']);
    Route::delete('/cart/empty', [CartController::class, 'empty']);
});

// Route::get('dashboard', [ManagerController::class, 'dashboard'])->name('admin.dashboard');
Route::resource('/Manager', ManagerController::class);
// Route::get('admin/managers', [ManagerController::class, 'index']);
// Route::get('managers/create', [ManagerController::class, 'create']);
// Route::post('managers/create', [ManagerController::class, 'store'])->name('add.manager');
// Route::get('managers/edit/{id}', [ManagerController::class, 'edit']);
// Route::post('managers/edit', [ManagerController::class, 'update'])->name('managers.edit');
// Route::get('managers/delete/{id}', [ManagerController::class, 'destroy'])->name('managers.destroy');
// Route::get('admin/dashboard', [ManagerController::class, 'dashboard']);
Route::get('ad/products', [adminProdController::class, 'products']);
Route::get('dashboard', [admincontroller::class, 'index']);