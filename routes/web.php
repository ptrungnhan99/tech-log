<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\WebController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'checkLogin']);
});

Route::prefix('admin')->middleware('login')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);


    Route::prefix('category')->group(function () {
        Route::get('', [CategoryController::class, 'index']);
        Route::get('/create', [CategoryController::class, 'create']);
        Route::post('/create', [CategoryController::class, 'store']);
        Route::get('/edit/{id}', [CategoryController::class, 'edit']);
        Route::put('/edit/{id}', [CategoryController::class, 'update']);
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('post')->group(function () {
        Route::get('', [PostController::class, 'index']);
        Route::get('/create', [PostController::class, 'create']);
        Route::post('/create', [PostController::class, 'store']);
        Route::get('/edit/{id}', [PostController::class, 'edit']);
        Route::put('/edit/{id}', [PostController::class, 'update']);
        Route::delete('/delete/{id}', [PostController::class, 'destroy']);
    });

    Route::prefix('user')->group(function () {
        Route::get('', [UserController::class, 'index']);
        Route::get('/create', [UserController::class, 'create']);
        Route::post('/create', [UserController::class, 'store']);
        Route::get('/edit/{id}', [UserController::class, 'edit']);
        Route::put('/edit/{id}', [UserController::class, 'update']);
        Route::delete('/delete/{id}', [UserController::class, 'destroy']);
    });

    Route::prefix('contact')->group(function () {
        Route::get('/', [ContactController::class, 'index']);
        Route::delete('/delete/{id}', [ContactController::class, 'destroy']);
    });
});
Route::get('/', [WebController::class, 'home']);
Route::get('/{slug}.html', [WebController::class, 'single'])
    ->where('slug', '[a-zA-Z0-9-_]+')
    ->name('single.post');
Route::post('/{slug}.html', [WebController::class, 'comment'])
    ->where('slug', '[a-zA-Z0-9-_]+')
    ->name('store.post');
Route::get('category/{slug}', [WebController::class, 'category'])
    ->where('slug', '[a-zA-Z0-9-_]+')
    ->name('category.post');
Route::get('/login', [LoginController::class, 'login'])->name('login.client');
Route::get('/login', [LoginController::class, 'login'])->name('login.client');
Route::post('/login', [LoginController::class, 'checkLogin']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.client');

Route::get('/lien-he', [WebController::class, 'contact']);
Route::post('/lien-he', [WebController::class, 'storeContact']);
