<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', [UserController::class, 'index'])->name('users.index');

Route::resource('users',UserController::class);
Route::post('/import-xml', [UserController::class, 'importXml'])->name('import.xml');
