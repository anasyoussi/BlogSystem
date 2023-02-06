<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController ;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\PostController as ViewPostController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\FavoriteController as AdminFavoriteController;
use App\Http\Controllers\Author\FavoriteController as AuthorFavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('posts', [App\Http\Controllers\PostController::class, 'index'])->name('post.index'); 

Route::post('subscriber', [App\Http\Controllers\SubscriberController::class, 'store'])->name('subscriber.store'); 

Route::get('post/{post:slug}', [ViewPostController::class, 'getSingle'])->name('post.details'); 

Auth::routes(); 
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::post('favorite/{post}/add', [FavoriteController::class, 'add'])->name('post.favorite');
    Route::post('comment/{post}', [CommentController::class, 'store'])->name('comment.store');
});

// Admin Dashboard
Route::group(['prefix' => 'admin',  'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tag', TagController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class); 
    // Profile Settings 
    Route::get('settings', [SettingsController::class, 'index'])->name('settings'); 
    Route::put('profile-update', [SettingsController::class, 'updateProfile'])->name('profile.updateProfile'); 
    Route::put('password-update', [SettingsController::class, 'updatePassword'])->name('password.updatePassword');  
    // Get Favorite 
    Route::get('/favorite', [AdminFavoriteController::class, 'index'])->name('favorite.index');  
    // Post : Pending & approve posts.
    Route::get('/pending/post', [PostController::class, 'pending'])->name('post.pending');
    Route::put('/post/{id}/approve',[PostController::class, 'approval'])->name('post.approve');   
    // Subscribers
    Route::get('/subscriber', [SubscriberController::class, 'index'])->name('subscriber.index'); 
    Route::delete('/subscriber/{subscriber}', [SubscriberController::class, 'destroy'])->name('subscriber.destroy'); 
    // Get Comments 
    Route::get('comments', [CommentController::class, 'index'])->name('comment.index');
    Route::delete('comments/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
});


// Author Dashboard
Route::group(['prefix' => 'author', 'as'=>'author.', 'middleware'=>['auth', 'author'] ], function () {
    Route::get('dashboard', [AuthorDashboardController::class, 'index'])->name('dashboard'); 
    Route::resource('post', App\Http\Controllers\Author\PostController::class);
    // Post : Pending & approve posts.
    Route::get('/pending/post', [App\Http\Controllers\Author\PostController::class, 'pending'])->name('post.pending');
    Route::put('/post/{id}/approve',[App\Http\Controllers\Author\PostController::class, 'approve'])->name('post.approve');  
    // Profile Settings 
    Route::get('settings', [App\Http\Controllers\Author\SettingsController::class, 'index'])->name('settings'); 
    Route::put('profile-update', [App\Http\Controllers\Author\SettingsController::class, 'updateProfile'])->name('profile.updateProfile'); 
    Route::put('password-update', [App\Http\Controllers\Author\SettingsController::class, 'updatePassword'])->name('password.updatePassword');
    // Get Favorite 
     Route::get('/favorite', [AuthorFavoriteController::class, 'index'])->name('favorite.index');  
    // Get Comments 
    Route::get('comments', [App\Http\Controllers\Author\CommentController::class, 'index'])->name('comment.index');
    Route::delete('comments/{id}', [App\Http\Controllers\Author\CommentController::class, 'destroy'])->name('comment.destroy');
});