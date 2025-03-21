<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return ($user->role == 1);
        });

        Gate::define('pengurus', function (User $user) {
            return ($user->role == 3 && $user->id_jabatan == null);
        });

        Gate::define('ustadz', function (User $user) {
            return ($user->role == 4);
        });

        Gate::define('user', function (User $user) {
            return ($user->role == 2);
        });

        Gate::define('produksi', function (User $user) {
            return ($user->id_jabatan == 2);
        });

        Gate::define('distribusi', function (User $user) {
            return ($user->id_jabatan == 1);
        });

        Gate::define('bendahara', function (User $user) {
            return ($user->id_jabatan == 3);
        });
        Gate::define('ketua', function (User $user) {
            return ($user->id_jabatan == 4);
        });
        //
    }
}