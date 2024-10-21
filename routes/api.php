<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/login', [AuthenticatedSessionController::class, 'create'])
// ->name('login');

// Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/sanctum/csrf-cookie', [\Laravel\Sanctum\Http\Controllers\CsrfCookieController::class, 'show']);

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';

