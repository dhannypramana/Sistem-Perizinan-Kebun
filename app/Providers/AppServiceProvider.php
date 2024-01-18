<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
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
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        Validator::extend('itera_email', function ($attribute, $value, $parameter, $validator) {
            return str_ends_with($value, '.itera.ac.id');
        });

        Validator::replacer('itera_email', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Alamat :attribute harus berakhir dengan .itera.ac.id. (Hanya berlaku bagi sivitas akademi itera)');
        });
    }
}
