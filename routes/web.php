<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivityFormController;

// Redirect default ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route jika user login, arahkan ke dashboard sesuai role
Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->hasRole('user')) {
        return redirect()->route('user.dashboard');
    } else {
        abort(403, 'Akses tidak diizinkan.');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Middleware untuk admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    Route::resource('forms', ActivityFormController::class); // CRUD form kegiatan
    Route::post('/forms/{activity}/approve', [ActivityFormController::class, 'approve'])->name('forms.approve');
    Route::post('/forms/{activity}/reject', [ActivityFormController::class, 'reject'])->name('forms.reject');
    Route::get('/status/pengajuan', [ActivityFormController::class, 'pengajuan'])->name('status.pengajuan');



    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');

    // Export
    Route::get('/forms/{activity}', [ActivityFormController::class, 'show'])->name('forms.show');
    Route::get('/forms/export/pdf', [ActivityFormController::class, 'exportPdf'])->name('forms.export.pdf');
    Route::get('/forms/export/excel', [ActivityFormController::class, 'exportExcel'])->name('forms.export.excel');
    Route::get('/forms/export/csv', [ActivityFormController::class, 'exportCsv'])->name('forms.export.csv');
});

// Middleware untuk user
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');

    // Resource dengan prefix user.activities.*
    Route::resource('activities', ActivityController::class)->names([
        'index' => 'activities.index',
        'create' => 'activities.create',
        'store' => 'activities.store',
        'show' => 'activities.show',
        'edit' => 'activities.edit',
        'update' => 'activities.update',
        'destroy' => 'activities.destroy',
    ]);
});

// Profile routes (global)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__ . '/auth.php';
