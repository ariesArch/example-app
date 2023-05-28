<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use App\Filament\Resources\CityResource;
use App\Filament\Resources\PageResource;
use App\Filament\Resources\UserResource;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationBuilder;
use App\Filament\Resources\TownshipResource;
use App\Filament\Resources\CommunityResource;
use App\Filament\Resources\CommunityCategoryResource;

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
        //
        DB::listen(function ($query) {
            Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });
        Filament::navigation(function (NavigationBuilder $builder): NavigationBuilder {
            return $builder
                ->groups([
                    NavigationGroup::make('Cities')
                        ->items([
                            ...CityResource::getNavigationItems(),
                            ...TownshipResource::getNavigationItems(),
                        ]),
                    NavigationGroup::make('Communities')
                        ->items([
                            ...CommunityCategoryResource::getNavigationItems(),
                            ...CommunityResource::getNavigationItems(),
                        ]),
                    NavigationGroup::make('Accounts')
                        ->items([
                            ...UserResource::getNavigationItems(),
                            ...PageResource::getNavigationItems(),
                        ]),
                ]);
        });
    }
}
