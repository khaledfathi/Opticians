<?php

namespace App\Providers;

use App\Repository\Contracts\Customer\CustomerRepositoryContract;
use App\Repository\Contracts\Frame\FrameRepositoryContract;
use App\Repository\Contracts\Lens\LensRepositoryContract;
use App\Repository\Contracts\Order\OrderDetailsRepositoryContract;
use App\Repository\Contracts\Order\OrderRepositoryContract;
use App\Repository\Contracts\User\UserRepositoryContract;
use App\Repository\Customer\CustomerRepository;
use App\Repository\Frame\FrameRepository;
use App\Repository\Lens\LensRepository;
use App\Repository\Order\OrderDetailsRepository;
use App\Repository\Order\OrderRepository;
use App\Repository\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryContract::class , UserRepository::class); 
        $this->app->bind(CustomerRepositoryContract::class , CustomerRepository::class); 
        $this->app->bind(FrameRepositoryContract::class , FrameRepository::class); 
        $this->app->bind(LensRepositoryContract::class , LensRepository::class); 
        $this->app->bind(OrderRepositoryContract::class , OrderRepository::class); 
        $this->app->bind(OrderDetailsRepositoryContract::class , OrderDetailsRepository::class); 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
