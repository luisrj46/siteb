<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Banner\Banner;
use App\Policies\Banner\BannerPolicy;
use App\Models\Property\Recommended;
use App\Models\Setting\GeneralSetting;
use App\Models\User\User;
use App\Policies\Recommended\RecommendedPolicy;
use App\Models\Promotion\Promotion;
use App\Models\Property\Property;
use App\Policies\Promotion\PromotionPolicy;
use App\Policies\Property\PropertyPolicy;
use App\Policies\Setting\GeneralSettingPolicy;
use App\Policies\User\UserPolicy;
use Database\Seeders\Roles\RolesSeeder;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Banner::class => BannerPolicy::class,
        GeneralSetting::class => GeneralSettingPolicy::class,
        Recommended::class => RecommendedPolicy::class,
        Promotion::class => PromotionPolicy::class,
        Property::class => PropertyPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //superAdministrador
        Gate::before(function ($user, $ability) {
            return $user->hasRole(RolesSeeder::ROOT) ? true : null;
        });

        
    }
}
