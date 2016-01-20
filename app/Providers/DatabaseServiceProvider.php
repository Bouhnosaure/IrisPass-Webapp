<?php namespace App\Providers;

use App\Repositories\Eloquent\UserConfirmationRepository;
use App\Repositories\Eloquent\UserProfileRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\UserConfirmationRepositoryInterface;
use App\Repositories\UserProfileRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\EventRepositoryInterface;
use App\Repositories\Eloquent\EventRepository;
use App\Repositories\CarpoolingRepositoryInterface;
use App\Repositories\Eloquent\CarpoolingRepository;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserConfirmationRepositoryInterface::class, UserConfirmationRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
