<?php

namespace App\Providers;

use App\Models\ChannelPartner;
use App\Models\ChannelPartnerType;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\SubSubProduct;
use App\Models\Zone;
use App\Ntrax\Repositories\ChannelPartnerType\ChannelPartnerTypeInterface;
use App\Policies\ChannelPartnerPolicy;
use App\Policies\ChannelPartnerTypePolicy;
use App\Policies\ProductPolicy;
use App\Policies\SubProductPolicy;
use App\Policies\SubSubProductPolicy;
use App\Policies\ZonePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Zone::class => ZonePolicy::class,
        ChannelPartner::class => ChannelPartnerPolicy::class,
        ChannelPartnerType::class => ChannelPartnerTypePolicy::class,
        Product::class => ProductPolicy::class,
        SubProduct::class => SubProductPolicy::class,
        SubSubProduct::class => SubSubProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
