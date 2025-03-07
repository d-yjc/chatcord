<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestEmailController;
use App\Http\Livewire\EditProfile;
use App\Http\Livewire\ProfileView;
use App\Http\Livewire\PostView;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Services\OpenEmojiService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::resource('posts', PostController::class);

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::resource('posts.comments', CommentController::class)->shallow();

Route::get('/test-email', [TestEmailController::class, 'sendTestEmail']);

Route::get('/dashboard', function () {
    $user = auth()->user();
    return view('dashboard', compact('user'));
})->middleware('auth')->name('dashboard');



Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');



Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [ProfileController::class, 'showMyProfile'])->name('profile.my');
    //Route::get('/profile/{user}', ProfileView::class)->name('profile.show');
    Route::get('/profile/{chatUser}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{user}/edit', EditProfile::class)->name('profile.edit');

    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
