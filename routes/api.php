<?php

use App\Http\Controllers\AccountCreationController;
use App\Http\Controllers\AccountLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantsController;

Route::post('account/create', [AccountCreationController::class, 'create']);
Route::post('account/login', [AccountLoginController::class, 'create']);

Route::get('tenants', [TenantsController::class, 'index']);
Route::get('tenants/{uuid}', [TenantsController::class, 'show']);
Route::post('tenants/create', [TenantsController::class, 'create']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
