<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\ProfileView;
use App\Http\Livewire\PostView;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::resource('posts', PostController::class);



Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::resource('posts.comments', CommentController::class)->shallow();



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');



Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [ProfileController::class, 'showMyProfile'])->name('profile.my');
    //Route::get('/profile/{user}', ProfileView::class)->name('profile.show');
    Route::get('/profile/{chatUser}', [ProfileController::class, 'show'])->name('profile.show');

    //Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
