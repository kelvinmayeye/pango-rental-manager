<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Tenants\LeaseController;
use App\Http\Controllers\Tenants\TenantController;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\Properties\CategoryController;
use App\Http\Controllers\Properties\PropertyController;
use App\Http\Controllers\Tenants\TenantPropertyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/','auth.login')->name('login');
Route::view('register','auth.signup');

Route::get('page', function () {
    return view('backend/users');
});

Route::middleware('auth')->group(function () {
    Route::resources([
        'tenants'=> TenantController::class,
        'users'=> UserController::class,
        'payments'=> PaymentController::class,
        'category'=> CategoryController::class,
        'properties'=> PropertyController::class,
        'leases'=> LeaseController::class,
        'tenants'=> TenantController::class,
        'tenantProperties'=> TenantPropertyController::class,
    ]);

});

require __DIR__.'/backend/usermanagement.php';

