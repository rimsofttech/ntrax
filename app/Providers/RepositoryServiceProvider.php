<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

/*********************************** */
use App\Ntrax\Repositories\Zone\ZoneInterface;
use App\Ntrax\Repositories\Zone\ZoneRepository;
use App\Ntrax\Repositories\Role\RoleInterface;
use App\Ntrax\Repositories\Role\RoleRepository;
use App\Ntrax\Repositories\Permission\PermissionInterface;
use App\Ntrax\Repositories\Permission\PermissionRepository;
use App\Ntrax\Repositories\User\UserInterface;
use App\Ntrax\Repositories\User\UserRepository;
use App\Ntrax\Repositories\ChannelPartner\ChannelPartnerInterface;
use App\Ntrax\Repositories\ChannelPartner\ChannelPartnerRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(ZoneInterface::class, ZoneRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(PermissionInterface::class, PermissionRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ChannelPartnerInterface::class, ChannelPartnerRepository::class);

    }

    public function provides()
    {
        return [
            ZoneInterface::class,
            RoleInterface::class,
            PermissionInterface::class,
            UserInterface::class,
            ChannelPartnerInterface::class,

        ];
    }
}
