<?php

use App\Http\Controllers\Api\Customer\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    // Rotas protegidas
});
Route::apiResource('/customers', CustomerController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
