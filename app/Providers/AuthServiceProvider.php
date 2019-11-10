<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Passport::routes();

        Passport::loadKeysFrom('');

        Passport::tokensExpireIn(now()->addMonths(6));

        Passport::refreshTokensExpireIn(now()->addMonths(6));

        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
