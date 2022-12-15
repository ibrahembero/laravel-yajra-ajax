<?php
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SubscriberController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bero', function () {
    return 'welcome bero';
});

Route::resource('blog', BlogController::class);

Route::resource('sub', SubscriberController::class);

// Route::get('blogs', [BlogController::class, 'index']);
// Route::get('blog/listing', [BlogController::class, 'getBlogs'])->name('blog.listing');
// Route::get('blog/listing', [BlogController::class, 'getBlogs'])->name('blog.listing');
//Route::get('blog/create', [BlogController::class, 'createBlog'])->name('blog.create');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
