<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserPostController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blogs.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.edit');
    Route::put('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [UserProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::post('/profile/upload-avatar', [UserProfileController::class, 'updateAvatar'])->name('profile.uploadAvatar');

    Route::get('/posts/create', [UserPostController::class, 'create'])->name('userposts.create');
    Route::post('/posts/store', [UserPostController::class, 'store'])->name('userposts.store');
    Route::post('/user/upload-image', [UserPostController::class, 'uploadImage'])->name('userupload.image');
    Route::get('/posts/{post}/edit', [UserPostController::class, 'edit'])->name('userposts.edit');
    Route::put('/posts/{post}', [UserPostController::class, 'update'])->name('userposts.update');
    Route::delete('/posts/{post}', [UserPostController::class, 'destroy'])->name('userposts.destroy');
    Route::get('/posts/tag/{tag}', [UserPostController::class, 'postsByTag'])->name('posts.byTag');

    Route::post('/blogs/{id}/like', [LikeController::class, 'like'])->middleware('throttle:10,1');
    Route::delete('/blogs/{id}/unlike', [LikeController::class, 'unlike'])->middleware('throttle:10,1');
    Route::get('/blogs/{post}/check-like', [LikeController::class, 'checkLike']);
    Route::post('/blogs/{post}/comments', [CommentController::class, 'store'])->middleware('throttle:5,1');
    Route::post('/blogs/comments/{commentId}/reply', [CommentController::class, 'replyToComment'])->middleware('throttle:5,1');

    Route::get('/search', [SearchController::class, 'index'])->name('search');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('/admin/users', UserController::class);
    Route::resource('/admin/posts', PostController::class);
    Route::get('/admin/posts/search', [PostController::class, 'search'])->name('posts.search');

    Route::resource('/admin/categories', CategoryController::class);
    Route::resource('/admin/series', SeriesController::class);
    Route::resource('/admin/bookmarks', BookmarkController::class)->only(['index', 'store', 'destroy']);
    Route::resource('/admin/likes', LikeController::class)->only(['index', 'store', 'destroy']);

    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('adminprofile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('adminprofile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('adminprofile.destroy');
});

require __DIR__.'/auth.php';
