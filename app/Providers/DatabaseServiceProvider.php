<?php namespace App\Providers;

use App\Repositories\CrmRepositoryInterface;
use App\Repositories\Eloquent\CrmRepository;
use App\Repositories\Eloquent\OrganizationRepository;
use App\Repositories\Eloquent\OsjsGroupRepository;
use App\Repositories\Eloquent\OsjsUserRepository;
use App\Repositories\Eloquent\UserConfirmationRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\WebsiteRepository;
use App\Repositories\OrganizationRepositoryInterface;
use App\Repositories\OsjsGroupRepositoryInterface;
use App\Repositories\OsjsUserRepositoryInterface;
use App\Repositories\UserConfirmationRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\WebsiteRepositoryInterface;
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
    }
}
