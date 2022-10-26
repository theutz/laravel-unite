<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Theutz\Unite\Definitions\DefinitionLoader;

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
        $this->registerLoader();
    }

    private function registerLoader(): void
    {
        $this->app->singleton(DefinitionLoader::class);
        $this->app->when(DefinitionLoader::class)
            ->needs('$unitsPath')
            ->giveConfig('unite.units');
    }
}
