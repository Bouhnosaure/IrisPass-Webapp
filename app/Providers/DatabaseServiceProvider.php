<?php namespace App\Providers;

use App\Repositories\Eloquent\OrganizationRepository;
use App\Repositories\Eloquent\OsjsGroupRepository;
use App\Repositories\Eloquent\OsjsUserRepository;
use App\Repositories\Eloquent\UserConfirmationRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\OrganizationRepositoryInterface;
use App\Repositories\OsjsGroupRepositoryInterface;
use App\Repositories\OsjsUserRepositoryInterface;
use App\Repositories\UserConfirmationRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;


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
        $this->app->bind(OsjsUserRepositoryInterface::class, OsjsUserRepository::class);
        $this->app->bind(OsjsGroupRepositoryInterface::class, OsjsGroupRepository::class);
        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
    }
}
