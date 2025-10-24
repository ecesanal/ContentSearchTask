<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminController;

Route::get('/', [SearchController::class, 'index'])->name('index');
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::match(['get', 'post'], '/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/content/edit/{id}', [AdminController::class, 'editContent'])->name('admin.editContent');
Route::post('/admin/content/update/{id}', [AdminController::class, 'updateContent'])->name('admin.updateContent');
Route::delete('/admin/content/delete/{id}', [AdminController::class, 'deleteContent'])->name('admin.deleteContent');
