<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\NavigationComposer;
use App\Http\ViewComposers\NewsComposer;
use App\Http\ViewComposers\NewsCategoryComposer;
use App\Http\ViewComposers\EventComposer;
use App\Http\ViewComposers\SliderComposer;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('modules.menu', NavigationComposer::class);
        view()->composer('modules.news', NewsComposer::class);
        view()->composer('pages.home', NewsCategoryComposer::class);
        view()->composer('modules.events', EventComposer::class);
        view()->composer('modules.slider', SliderComposer::class);
    }
}
