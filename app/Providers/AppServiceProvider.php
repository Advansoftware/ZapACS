<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    private $objUser;
    public function __construct()
    {
        $this->objUser=new User();
    }
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
        // Using class based composers...
        //View::share('variable1', $this->objConfigWhats::all());
        //View::composer('*', WhatsConfigComposer::class);
     /*   View::composer('*', function ($view) {
            $view->with('count',);

        });*/
       // View::creator('profile', $this->objConfigWhats::all());
        Schema::defaultStringLength(191);
        // Using closure based composers...
       /*View::composer('*', function ($view) {
            $configura = $this->objUser->get()->where('em_uso', '=', 1);

            foreach($configura as $user){
                $view->with('api_url', $user['api_url']);
            }

        });*/
    }
}

