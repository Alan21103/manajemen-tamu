<?php

use App\Http\Controllers\Admin\TamuExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/datatamu', [AdminController::class, 'index'])->name('admin.index');
});


Route::get('/form', function () {
    return view('tamu.create');
});

Route::get('/tamu', [TamuController::class, 'index'])->name('tamu.index');
Route::post('/tamu', [TamuController::class, 'store'])->name('tamu.store');
Route::get('/tamu/{id}/edit', [TamuController::class, 'edit'])->name('tamu.edit');
Route::delete('/tamu/{id}', [TamuController::class, 'destroy'])->name('tamu.destroy');
Route::get('/tamu/create', [TamuController::class, 'create'])->name('tamu.create');




Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');


Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('dashboard');

// Rute untuk ekspor data tamu
Route::get('/admin/export', [TamuExportController::class, 'export'])->name('admin.export')->middleware('auth');
Route::get('/admin/export-page', [TamuExportController::class, 'exportPage'])->name('admin.export.page')->middleware('auth');

Route::get('/tambahdata', [AdminController::class, 'Tambahdata'])->name('admin.tambahdata');

require __DIR__ . '/auth.php';
