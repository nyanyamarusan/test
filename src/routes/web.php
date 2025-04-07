<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'index']);
});
Route::get('/admin/export', [AuthController::class, 'export'])->name('export');;
Route::get('/admin/search', [AuthController::class, 'search']);
Route::delete('/admin/delete', [AuthController::class, 'destroy']);
Route::post('/register', [AuthController::class,'store']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class,'logout']);
Route::get('/', [ContactController::class,'index']);
Route::post('/confirm', [ContactController::class,'confirm']);
Route::post('/thanks', [ContactController::class,'store']);