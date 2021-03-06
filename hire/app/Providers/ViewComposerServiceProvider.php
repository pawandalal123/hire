<?php 
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
class ViewComposerServiceProvider extends ServiceProvider {
    public function boot() 
    {
       
        view()->composer("includes/web/companyleftbar","App\Http\ViewComposers\AutologinComposer");
        view()->composer("includes/web/userleftbar","App\Http\ViewComposers\AutologinComposer");
        view()->composer("includes/web/userprofileleftbar","App\Http\ViewComposers\AutologinComposer");
         view()->composer("includes/web/header","App\Http\ViewComposers\AutologinComposer");
        view()->composer("layout/default","App\Http\ViewComposers\AutologinComposer");
        view()->composer("layout/adminlayout","App\Http\ViewComposers\AutologinComposer");
        view()->composer("layout/seconddefault","App\Http\ViewComposers\AutologinComposer");
        view()->composer("auth/login","App\Http\ViewComposers\AutologinComposer");
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
}