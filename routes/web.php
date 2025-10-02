<?php

use App\Http\Controllers\ApprovalTugasController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => 'auth', 'prefix' => '/'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/sidebar/toggle', [SidebarController::class, 'toggle'])->name('sidebar.toggle');

    Route::group(['prefix' => 'penugasan', 'as' => 'penugasan.'], function () {
        Route::get('/', [PenugasanController::class, 'index'])->name('index');
        Route::get('/create', [PenugasanController::class, 'create'])->name('create');
        Route::post('/store', [PenugasanController::class, 'store'])->name('store');
        Route::get('/detail/{id}', [PenugasanController::class, 'detail'])->name('detail');
        Route::get('/selesai/{id}', [PenugasanController::class, 'selesai'])->name('selesai');
        Route::get('/update/{id}', [PenugasanController::class, 'update'])->name('update');
        Route::put('/diterima/{id}', [PenugasanController::class, 'diterima'])->name('diterima');
        Route::post('/ditolak', [PenugasanController::class, 'ditolak'])->name('ditolak');
    });

    Route::group(['prefix' => 'kehadiran', 'as' => 'kehadiran.'], function () {
        Route::get('/', [KehadiranController::class, 'index'])->name('index');
    });

    Route::group(['middleware' => 'isAdmin', 'prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::put('/{id}', [UserController::class, 'edit'])->name('edit');
        Route::delete('delete/{id}', [UserController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'izin', 'as' => 'izin.'], function () {
        Route::get('/', [IzinController::class, 'index'])->name('index');
        Route::post('/store', [IzinController::class, 'store'])->name('store');
        Route::put('/diterima/{id}', [IzinController::class, 'diterima'])->name('diterima');
        Route::put('/ditolak/{id}', [IzinController::class, 'ditolak'])->name('ditolak');
        Route::delete('delete/{id}', [IzinController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'approval-tugas', 'as' => 'approval-tugas.'], function () {
        Route::get('/', [ApprovalTugasController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'aset', 'as' => 'aset.'], function () {
        Route::get('/', [AsetController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [AsetController::class, 'detail'])->name('detail');
        Route::get('/create', [AsetController::class, 'create'])->name('create');
        Route::post('/store', [AsetController::class, 'store'])->name('store');
        Route::get('/update', [AsetController::class, 'update'])->name('update');
    });
});
