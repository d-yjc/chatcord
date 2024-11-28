<?php

namespace App\Providers;
use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('comments-list', \App\Http\Livewire\CommentsList::class);
        Livewire::component('add-comment', \App\Http\Livewire\AddComment::class);
    }
}
