<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('cstm_xss_filter', function ($attribute, $value, $parameters, $validator) {
            $value = strtolower($value);
            $list = array("'", '"', "/", "\\", ";", ":", "-", "_", "*", "&", "^", "%", "$", "#", "@", "~", "alert", "script", ".", ",");
            foreach ($list as $ch) {
                if (!is_bool(strpos($value, $ch)))
                    return false;
            }
            return true;
        }
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public
    function register()
    {
        //
    }
}
