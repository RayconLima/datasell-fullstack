<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;

Route::get('/users', function () {
    $users = User::all();

    return $users;
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');