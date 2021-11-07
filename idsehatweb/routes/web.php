<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganController;
use App\Models\Blog;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/articles/penyakit-mematikan-di-indonesia', [HomeController::class, 'show']);


Route::get('/organ-manusia', [OrganController::class, 'index']);
Route::get('/articles/anatomi-tubuh-manusia', [OrganController::class, 'show']);

// laman kasus
Route::get('/kasus-penyakit-di-indonesia', function() {
    return view('cases');
});
// data kasus
Route::get('/kasus-penyakit-di-indonesia/data-kasus', function() {
    return view('/data/kasus');
});

// contact us
Route::get('/contact', function () {
    return view('contactus');
});

// login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


// admin
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth');

Route::resource('/blogs', BlogController::class)->middleware('auth');

Route::resource('/posts', BlogPostController::class)->middleware('auth');


// forum
Route::resource('/forum', ForumController::class);