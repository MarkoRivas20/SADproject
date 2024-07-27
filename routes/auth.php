<?php

use App\Http\Controllers\Auth\CdpController;
use App\Http\Controllers\Auth\CreditController;
use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\PartnerController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\DocumentController;
use App\Http\Controllers\Auth\MyDocumentController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class,'index'])->name('authenticate.home');

Route::get('partner/{partner}/disable', [PartnerController::class,'disable'])->name('authenticate.partner.disable');
Route::resource('partner', PartnerController::class)->except('show')->names('authenticate.partner');

Route::resource('role', RoleController::class)->except('show')->names('authenticate.role');

Route::get('user/{user}/disable', [UserController::class,'disable'])->name('authenticate.user.disable');
Route::get('user/{user}/setpass', [UserController::class,'setpass'])->name('authenticate.user.setpass');
Route::resource('user', UserController::class)->except('show')->names('authenticate.user');
Route::get('profile', [UserController::class,'profile'])->name('authenticate.user.profile');

Route::get('credit/{credit}/disable', [CreditController::class,'disable'])->name('authenticate.credit.disable');
Route::post('credit/{credit}/upload', [CreditController::class, 'upload'])->name('authenticate.credit.upload');
Route::resource('credit', CreditController::class)->except('show','store','update','destroy')->names('authenticate.credit');

Route::get('cdp/{cdp}/disable', [CdpController::class,'disable'])->name('authenticate.cdp.disable');
Route::post('cdp/{cdp}/upload', [CdpController::class, 'upload'])->name('authenticate.cdp.upload');
Route::resource('cdp', CdpController::class)->except('show','store','update','destroy')->names('authenticate.cdp');

Route::resource('mydocument', MyDocumentController::class)->except('show','destroy')->names('authenticate.mydocument');
Route::get('mydocument/{document}/disable', [MyDocumentController::class,'disable'])->name('authenticate.mydocument.disable');

Route::get('document', [DocumentController::class,'index'])->name('authenticate.document.index');