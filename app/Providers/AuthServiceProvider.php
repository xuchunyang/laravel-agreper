<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::before(function (User $user, $ability) {
            if ($user->is_admin) {
                return true;
            }

            if ($user->is_moderator && $ability !== 'admin') {
                return true;
            }

            return null;
        });

        Gate::define('admin', function (User $user) {
            return $user->is_admin;
        });

        Gate::define('register', function (?User $user) {
            /** @var Setting $setting */
            $setting = View::shared('setting');
            return $setting->registration_enabled;
        });
    }
}
