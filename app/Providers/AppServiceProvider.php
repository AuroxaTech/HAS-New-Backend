<?php

namespace App\Providers;


use Auth;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Auth\AuthRepositoryInterface;
use App\Repositories\Auth\AuthRepository;
use App\Interfaces\PropertyRepositoryInterface;
use App\Repositories\PropertyRepository;
use App\Interfaces\ServiceRepositoryInterface;
use App\Repositories\ServiceRepository;
use App\Interfaces\TenantRepositoryInterface;
use App\Repositories\TenantRepository;
use App\Interfaces\PropertyFavouriteRepositoryInterface;
use App\Repositories\PropertyFavouriteRepository;
use App\Interfaces\ServiceFavouriteRepositoryInterface;
use App\Repositories\ServiceFavouriteRepository;
use App\Interfaces\ReviewRepositoryInterface;
use App\Repositories\ReviewRepository;
use App\Interfaces\ContractRepositoryInterface;
use App\Repositories\ContractRepository;


class AppServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(PropertyRepositoryInterface::class,PropertyRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(TenantRepositoryInterface::class, TenantRepository::class);
        $this->app->bind(PropertyFavouriteRepositoryInterface::class, PropertyFavouriteRepository::class);
        $this->app->bind(ServiceFavouriteRepositoryInterface::class, ServiceFavouriteRepository::class);
        $this->app->bind(ReviewRepositoryInterface::class, ReviewRepository::class);
        $this->app->bind(ContractRepositoryInterface::class, ContractRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
