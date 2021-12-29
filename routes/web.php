<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/form-login', [AdminController::class, 'formLogin'])->name('admin.form');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');

//    Category
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::get('{id}/show', [CategoryController::class, 'show'])->name('category.show');
        Route::get('{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::post('{id}/update', [CategoryController::class, 'update'])->name('category.update');
    });
});

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
});
