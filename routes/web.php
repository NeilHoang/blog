<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;

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
//   Home
Route::get('/', [HomeController::class, 'index'])->name('home');
//   Detail
Route::get('detail/{slug}/{id}', [HomeController::class, 'detail'])->name('detail');
Route::post('save-comment/{slug}/{id}', [HomeController::class, 'save_comment'])->name('save-comment');


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/form-login', [AdminController::class, 'formLogin'])->name('admin.form');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
//    Setting
    Route::get('/setting', [SettingController::class, 'setting'])->name('setting');
    Route::post('/save-setting', [SettingController::class, 'save_settings'])->name('setting.save');

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
//    Post
    Route::prefix('post')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('post.index');
        Route::get('create', [PostController::class, 'create'])->name('post.create');
        Route::post('store', [PostController::class, 'store'])->name('post.store');
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::get('{id}/show', [PostController::class, 'show'])->name('post.show');
        Route::get('{id}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
        Route::post('{id}/update', [PostController::class, 'update'])->name('post.update');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
