<?php

namespace App\Providers;

use App\Repositories\UserAccountRepository;
use App\Repositories\UserAccountRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            UserAccountRepositoryInterface::class,
            UserAccountRepository::class
        );
    }
}
