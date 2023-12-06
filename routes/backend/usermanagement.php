<?php

use App\Models\Leases\Lease;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Tenants\TenantPropertyController;

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('authenticates', 'authenticate')->name('authentication');
    Route::post('register', 'register')->name('registration');
    Route::get('signup', 'getRegistration')->name('signup');
    Route::get('logout', 'logout')->name('logout');
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        $userID = auth()->user()->id;

        $leases = Lease::whereHas('tenantProperty.property', function ($query) use ($userID) {
            $query->where('user_id', $userID);
        })->where(function ($query) {
            $query->whereIn('status_id', [1,2,3]);
        })->latest()->paginate(10);
        return view('index',compact('leases'));
    })->name('dashboard');

    Route::get('tenantProperties/{id}/status',[TenantPropertyController::class, 'activateTenantProperty'])->name('tenantProperties.status');

    Route::get('lease/{id}/amount',[PaymentController::class, 'getLeaseAmount'])->name('lease.amount');

});