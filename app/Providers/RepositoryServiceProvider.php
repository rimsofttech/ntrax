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
use App\Ntrax\Repositories\ChannelPartnerType\ChannelPartnerTypeInterface;
use App\Ntrax\Repositories\ChannelPartnerType\ChannelPartnerTypeRepository;
use App\Ntrax\Repositories\Product\ProductInterface;
use App\Ntrax\Repositories\Product\ProductRepository;
use App\Ntrax\Repositories\SubProduct\SubProductInterface;
use App\Ntrax\Repositories\SubProduct\SubProductRepository;
use App\Ntrax\Repositories\SubSubProduct\SubSubProductInterface;
use App\Ntrax\Repositories\SubSubProduct\SubSubProductRepository;

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
        $this->app->bind(ChannelPartnerTypeInterface::class, ChannelPartnerTypeRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(SubProductInterface::class, SubProductRepository::class);
        $this->app->bind(SubSubProductInterface::class, SubSubProductRepository::class);

    }

    public function provides()
    {
        return [
            ZoneInterface::class,
            RoleInterface::class,
            PermissionInterface::class,
            UserInterface::class,
            ChannelPartnerInterface::class,
            ChannelPartnerTypeInterface::class,
            ProductInterface::class,
            SubProductInterface::class,
            SubSubProductInterface::class,

        ];
    }
}
