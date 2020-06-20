<?php

namespace App\Providers;

use App\Domain\Person\Factory\SinglePersonFactory;
use App\Domain\Person\Factory\TwoPersonFactory;
use App\Domain\Person\PersonMapper;
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
        $this->app->singleton(PersonMapper::class, static function () {
            return new PersonMapper(
                [
                    new SinglePersonFactory(),
                    new TwoPersonFactory(),
                ]
            );
        });
    }
}
