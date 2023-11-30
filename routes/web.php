<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Tenants\LeaseController;
use App\Http\Controllers\Tenants\TenantController;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\Auth\AuthenticationController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('page', function () {
    return view('backend/users');
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('authenticates', 'authenticate')->name('authentication');
    Route::get('signup', 'getRegistration')->name('signup');
    Route::get('logout', 'logout')->name('logout');
});

Route::view('register','auth.signup');
Route::get('dashboard', function () {
    return view('index');
})->name('dashboard');

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



