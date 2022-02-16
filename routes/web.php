<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogPageController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\AdminContactController;

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


Route::get('/', [HomePageController::class, 'render'])->name('index');

Route::get('/blog', [BlogPageController::class, 'render'])->name('blog');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::resource('/contact', ContactController::class)->only(['create', 'store']);

Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');

Route::get('/search', [SearchController::class, 'searchTerm'])->name('search');

Auth::routes();




// USER PROFILE
Route::group(['middleware' => ['auth:sanctum', 'verified']], function ()
{
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('/post/{post}/comment', [PostController::class, 'comment'])->name('post.comment');

    Route::post('/post/{post}/comment/{comment}/reply', [PostController::class, 'reply'])->name('post.reply');

    Route::resource('post', PostController::class)->except('show');
    
    Route::put('/profile/{profile}/update/image', [ProfileController::class, 'updateImage'])->name('profile.image');

    Route::resource('profile', ProfileController::class)->only(['index', 'edit', 'update']);

});


// ADMIN PROFILE
Route::group(['middleware' => ['auth:sanctum', 'verified', 'authadmin'], 'prefix' => 'admin'], function ()
{
    Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::post('/post/{post}/approve', [PostController::class, 'updateStatus'])->name('post.approve');

    Route::resource('category', CategoryController::class)->except(['show']);

    Route::get('/contact', [AdminContactController::class, 'render'])->name('admin.contact');
});
