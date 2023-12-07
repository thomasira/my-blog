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

Route::get('/', function () {
    return view('welcome');
});
Route::get('blog', [BlogPostController::class, 'index'])->name('blog.index');
Route::get('blog/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show');
Route::get('blog-create', [BlogPostController::class, 'create'])->name('blog.create');
Route::post('blog-create', [BlogPostController::class, 'store'])->name('blog.store');
Route::get('blog-edit/{blogPost}', [BlogPostController::class, 'edit'])->name('blog.edit');
Route::put('blog-edit/{blogPost}', [BlogPostController::class, 'update'])->name('blog.update');
Route::delete('blog/{blogPost}', [BlogPostController::class, 'destroy'])->name('blog.delete');

Route::get('query', [BlogPostController::class, 'query']);
Route::get('blog-page', [BlogPostController::class, 'pagination']);


Route::get('registration', [CustomAuthController::class, 'create'])->name('auth.create');
Route::post('registration', [CustomAuthController::class, 'store'])->name('auth.create');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('authent', [CustomAuthController::class, 'authentification'])->name('authent');