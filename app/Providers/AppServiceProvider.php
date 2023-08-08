<?php

namespace App\Providers;

use App\Interfaces\CachedPostsInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Repositories\PostRepository;
use App\Services\CachedPostService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CachedPostsInterface::class, CachedPostService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
