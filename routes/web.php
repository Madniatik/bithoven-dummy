<?php

use Bithoven\Dummy\Http\Controllers\DummyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->prefix('dummy')->name('dummy.')->group(function () {
    Route::get('/', [DummyController::class, 'index'])->name('index');
    Route::post('/', [DummyController::class, 'store'])->name('store');
    Route::put('/{item}', [DummyController::class, 'update'])->name('update');
    Route::delete('/{item}', [DummyController::class, 'destroy'])->name('destroy');
});
