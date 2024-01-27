<?php

use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\PartnerController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class,'index']);

Route::get('partner/{partner}/disable', [PartnerController::class,'disable'])->name('authenticate.partner.disable');
Route::resource('partner', PartnerController::class)->names('authenticate.partner');

Route::get('user/{user}/disable', [UserController::class,'disable'])->name('authenticate.user.disable');
Route::get('user/{user}/setpass', [UserController::class,'setpass'])->name('authenticate.user.setpass');
Route::resource('user', UserController::class)->names('authenticate.user');