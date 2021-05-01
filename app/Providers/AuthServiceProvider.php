<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
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

    Passport::routes();
    Passport::tokensExpireIn(now()->addDays(15));
    Passport::refreshTokensExpireIn(now()->addDays(30));
    Passport::personalAccessTokensExpireIn(now()->addMonths(6));

    // Mandatory to define Scope
    Passport::tokensCan([
        'admin' => 'Add/Edit/Delete Data',
        'admin-hrd' => 'Add/Edit Data',
        'kepala-unit' => 'Add/Edit Data',
        'user' => 'List Data'
    ]);

    Passport::setDefaultScope([
        'user'
    ]);
    }
}
