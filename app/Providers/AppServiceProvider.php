<?php

namespace App\Providers;
use App\Services\OpenEmojiService;
use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(OpenEmojiService::class, function($app)
        {
            return new OpenEmojiService
            (
                config('services.openemoji_api.base_url'),  
                config('services.openemoji_api.api_key')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('profile-view', \App\Http\Livewire\ProfileView::class);
        Livewire::component('comments-list', \App\Http\Livewire\CommentsList::class);
        Livewire::component('add-comment', \App\Http\Livewire\AddComment::class);
        Livewire::component('emoji-picker', \App\Http\Livewire\EmojiPicker::class);

    }
}
