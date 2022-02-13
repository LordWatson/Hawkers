<?php

namespace App\Providers;

use App\Repository\Post\PostInterface;
use App\Repository\Post\PostRepository;
use App\Repository\Role\RoleInterface;
use App\Repository\Role\RoleRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostInterface::class,PostRepository::class);
        $this->app->bind(RoleInterface::class,RoleRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
