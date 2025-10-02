<?php

use App\Http\Controllers\ApprovalTugasController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\ProjectController;
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

    Route::group(['prefix' => 'project', 'as' => 'project.'], function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/store', [ProjectController::class, 'store'])->name('store');
        Route::put('/update/{id}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProjectController::class, 'delete'])->name('delete');
        Route::get('/detail/{id}', [ProjectController::class, 'detail'])->name('detail');
        Route::post('/storeTask', [ProjectController::class, 'storeTask'])->name('storeTask');
        Route::put('/editTask/{id}', [ProjectController::class, 'editTask'])->name('editTask');
        Route::delete('/deleteTask/{id}', [ProjectController::class, 'deleteTask'])->name('deleteTask');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::put('/{id}', [UserController::class, 'edit'])->name('edit');
        Route::delete('delete/{id}', [UserController::class, 'delete'])->name('delete');
    });

});
