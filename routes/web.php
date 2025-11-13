<?php

use Bithoven\Dummy\Http\Controllers\DummyController;
use Bithoven\Dummy\Http\Controllers\DashboardController;
use Bithoven\Dummy\Http\Controllers\ReportsController;
use Bithoven\Dummy\Http\Controllers\SettingsController;
use Bithoven\Dummy\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->prefix('dummy')->name('dummy.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Items
    Route::prefix('items')->name('items.')->group(function () {
        Route::get('/', [DummyController::class, 'index'])->name('index');
        Route::post('/', [DummyController::class, 'store'])->name('store');
        Route::put('/{item}', [DummyController::class, 'update'])->name('update');
        Route::delete('/{item}', [DummyController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-delete', [DummyController::class, 'bulkDelete'])->name('bulk-delete');
    });
    
    // Reports
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    Route::get('/reports/export', [ReportsController::class, 'export'])->name('reports.export');
    
    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    
    // About
    Route::get('/about', [AboutController::class, 'index'])->name('about');
});
