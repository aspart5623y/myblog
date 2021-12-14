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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomePageController::class, 'render'])->name('index');

Route::get('/blog', [BlogPageController::class, 'render'])->name('blog');

Route::get('/post/{id}', [BlogPostController::class, 'render'])->name('post');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', [ContactController::class, 'render'])->name('contact');

Route::post('/contact', [ContactController::class, 'sendMessage'])->name('send.message');

Route::get('/search', [SearchController::class, 'searchTerm'])->name('search');

Auth::routes();





// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('authadmin');
// Route::get('/admin/manage-categories', [CategoryController::class, 'render'])->name('admin.category')->middleware('authadmin');



// USER PROFILE
Route::group(['middleware' => ['auth:sanctum', 'verified']], function ()
{
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/all-posts', [PostController::class, 'render'])->name('all.posts');

    Route::get('/add-post', [PostController::class, 'addNew'])->name('add.post');

    Route::post('/add-post', [PostController::class, 'storePost'])->name('save.post');

    Route::get('/approve-post/{id}', [PostController::class, 'updateStatus'])->name('update.poststatus');

    Route::get('/delete-post/{id}', [PostController::class, 'deletePost'])->name('delete.poststatus');

    Route::get('/edit-post/{id}', [PostController::class, 'editPost'])->name('edit.poststatus');

    Route::post('/update-post', [PostController::class, 'updatePost'])->name('update.post');

    Route::get('/profile', [ProfileController::class, 'render'])->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('edit.profile');

    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('update.profile');

    Route::post('/profile/update/image', [ProfileController::class, 'updateImage'])->name('update.image');
});


// ADMIN PROFILE
Route::group(['middleware' => ['auth:sanctum', 'verified', 'authadmin']], function ()
{
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::get('/admin/manage-categories', [CategoryController::class, 'render'])->name('admin.category');

    Route::get('/admin/add-categories', [CategoryController::class, 'addNew'])->name('admin.addcategory');

    Route::post('/admin/add-categories', [CategoryController::class, 'storeCategory'])->name('category.store');

    Route::get('/admin/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('admin.editcategory');

    Route::post('/admin/update-category', [CategoryController::class, 'updateCategory'])->name('category.update');

    Route::get('/admin/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.deletecategory');

    Route::get('/admin/contact', [AdminContactController::class, 'render'])->name('admin.contact');


});
