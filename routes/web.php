<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/edit/{user}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/update/{user}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/delete/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');
