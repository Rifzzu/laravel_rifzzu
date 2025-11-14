<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return auth() ? redirect()->route('hospitals.index') : redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('hospitals', HospitalController::class);
    Route::get('patients/filter', [PatientController::class, 'filter'])->name('patients.filter');
    Route::resource('patients', PatientController::class);
});
