<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\V1\UserObserver;
use App\Repository\Classes\ClassesInterface;
use App\Repository\Classes\ClassesRepository;
use App\Repository\Post\PostInterface;
use App\Repository\Post\PostRepository;
use App\Repository\Role\RoleInterface;
use App\Repository\Role\RoleRepository;
use Illuminate\Http\Resources\Json\JsonResource;
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
        $this->app->bind(ClassesInterface::class,ClassesRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
        User::observe(UserObserver::class);
    }
}
