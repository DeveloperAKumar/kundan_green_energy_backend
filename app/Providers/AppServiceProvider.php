<?php

namespace App\Providers;

use App\Models\SiteSetting; 
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void{
        View::composer("*", function($view){
            $site_setting = Cache::remember('site_setting', now()->addMinutes(10), function(){
                return SiteSetting::first();
            }); 
            $view->with('site_setting', $site_setting); 
        });
    }
}
