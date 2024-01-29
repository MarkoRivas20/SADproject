<?php

use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\PartnerController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class,'index'])->name('authenticate.home');

Route::get('partner/{partner}/disable', [PartnerController::class,'disable'])->name('authenticate.partner.disable');
Route::resource('partner', PartnerController::class)->except('show')->names('authenticate.partner');

Route::resource('role', RoleController::class)->except('show')->names('authenticate.role');

Route::get('user/{user}/disable', [UserController::class,'disable'])->name('authenticate.user.disable');
Route::get('user/{user}/setpass', [UserController::class,'setpass'])->name('authenticate.user.setpass');
Route::resource('user', UserController::class)->except('show')->names('authenticate.user');
Route::get('profile', [UserController::class,'profile'])->name('authenticate.user.profile');
