<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController ;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home'); 


Auth::routes(); 
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Admin Dashboard
Route::group(['prefix' => 'admin',  'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tag', TagController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);

    // Post : Pending & approve posts.
    Route::get('/pending/post', [PostController::class, 'pending'])->name('post.pending');
    Route::put('/post/{id}/approve',[PostController::class, 'approval'])->name('post.approve');  
});


// Author Dashboard
Route::group(['prefix' => 'author', 'as'=>'author.', 'middleware'=>['auth', 'author'] ], function () {
    Route::get('dashboard', [AuthorDashboardController::class, 'index'])->name('dashboard'); 
    Route::resource('post', App\Http\Controllers\Author\PostController::class);
    // Post : Pending & approve posts.
    Route::get('/pending/post', [App\Http\Controllers\Author\PostController::class, 'pending'])->name('post.pending');
    Route::put('/post/{id}/approve',[App\Http\Controllers\Author\PostController::class, 'approve'])->name('post.approve');  
});