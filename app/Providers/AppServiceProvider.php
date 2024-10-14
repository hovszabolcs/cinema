<?php

namespace App\Providers;

use App\Http\Resources\BaseResource;
use App\Http\Resources\BaseResourceCollection;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        BaseResource::withoutWrapping();
        BaseResourceCollection::withoutWrapping();
    }
}
