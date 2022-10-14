<?php

namespace App\Providers;

use App\Exceptions\MissingDatabaseSeedingException;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!app()->runningInConsole()) {
            if (!($setting = Setting::first())) {
                throw new MissingDatabaseSeedingException;
            }
            View::share('setting', $setting);
        }
    }
}
