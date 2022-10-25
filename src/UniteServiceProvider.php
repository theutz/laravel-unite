<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class UniteServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-unite')
            ->hasConfigFile()
            ->hasTranslations();
    }

    public function packageRegistered(): void
    {
        $this->registerGeneratedUnits();
    }

    private function registerGeneratedUnits(): void
    {
        $this->app->singleton(GeneratedUnits::class);

        $this->app->when(GeneratedUnits::class)
            ->needs('$units')
            ->giveConfig('unite.units');
    }
}
