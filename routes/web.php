<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CustomAuthController;

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

Route::get('/', function () { return view('welcome'); });

Route::get('blog', [BlogPostController::class, 'index'])->name('blog.index');
Route::get('blog/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show');
Route::get('blog-create', [BlogPostController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('blog-create', [BlogPostController::class, 'store'])->name('blog.store')->middleware('auth');
Route::get('blog-edit/{blogPost}', [BlogPostController::class, 'edit'])->name('blog.edit')->middleware('auth');
Route::put('blog-edit/{blogPost}', [BlogPostController::class, 'update'])->name('blog.update')->middleware('auth');
Route::delete('blog/{blogPost}', [BlogPostController::class, 'destroy'])->name('blog.delete')->middleware('auth');

Route::get('query', [BlogPostController::class, 'query']);
Route::get('blog-page', [BlogPostController::class, 'pagination']);

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
Route::get('registration', [CustomAuthController::class, 'create'])->name('auth.create');
Route::post('registration', [CustomAuthController::class, 'store'])->name('auth.create');
Route::post('authent', [CustomAuthController::class, 'authentification'])->name('authent');

Route::get('user-list', [CustomAuthController::class, 'userList'])->name('user.list')->middleware('auth');
