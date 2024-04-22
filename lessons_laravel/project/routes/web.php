<?php

use App\Http\Controllers\PollTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('poll-types')->name('poll-types.')->group(function () {
    Route::get('/', [PollTypeController::class, 'index'])->name('index');
    Route::get('/create', [PollTypeController::class, 'create'])->name('create');
    Route::post('/', [PollTypeController::class, 'store'])->name('store');
});