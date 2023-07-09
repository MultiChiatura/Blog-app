<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'index']);

Route::resource('/post', PostController::class)->names('post')->only('index', 'show');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/post', PostController::class)->names('post')->except('index', 'show');
    Route::get('/post/{post}/like-toggle', [PostController::class, 'likeToggle'])->name('post.like-toggle');

    Route::controller(CommentController::class)->group(function () {
        Route::post('/comment/{post}', 'store')->name('comment.store');
        Route::delete('/comment/{comment}', 'destroy')->name('comment.destroy');
    });
});



require __DIR__.'/auth.php';
