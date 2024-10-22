<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/login', [AuthenticatedSessionController::class, 'create'])
// ->name('login');

// Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/sanctum/csrf-cookie', [\Laravel\Sanctum\Http\Controllers\CsrfCookieController::class, 'show']);
Route::middleware('auth:sanctum')->get('/user', function () {
    return response()->json([
        'status' => true,
        'user' => Auth::user(),
    ]);
});

Route::get('/logout', function () {
    Auth::logout();
    return response()->json([
        'status' => true,
    ]);
})->middleware('auth:sanctum');

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';

