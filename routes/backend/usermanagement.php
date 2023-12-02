<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('authenticates', 'authenticate')->name('authentication');
    Route::post('register', 'register')->name('registration');
    Route::get('signup', 'getRegistration')->name('signup');
    Route::get('logout', 'logout')->name('logout');
});


Route::middleware('auth')->group(function () {
Route::get('dashboard', function () {
    return view('index');
})->name('dashboard');

});