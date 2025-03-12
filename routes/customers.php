<?php

use App\Http\Controllers\Api\Customer\CustomerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/customers', CustomerController::class);