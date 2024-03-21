<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

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
        if(App::environment(['production'])){ //.envファイルの APP_ENV の値を拾ってくる
            URL::forceScheme('https');
            // 「.env の APP_ENV の値が'production'の時にURLがhttps化する」
        }
    }
}
