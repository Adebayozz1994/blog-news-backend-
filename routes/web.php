<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function(){
    return view ('dashboard');
})->middleware(CheckGuest::class)->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(CheckGuest::class)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});
// Route::get('show_session_data', function (){ 
//     dd(session()->all());
// });

// Route::get('store_session_data', function (Request $request){ 
//     // $request->session()->put('username', 'adebayozz');
//     session([
//         'username' => 'adebayozz',
//         'email' => 'adebayozz@gmail.com'
//     ]);
// });




require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

