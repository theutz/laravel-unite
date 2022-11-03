<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Theutz\Unite\Collections\UnitsCollection;
use Theutz\Unite\Loaders\Units;

class UniteServiceProvider extends PackageServiceProvider
{
    public $singletons = [
        Units::class,
        UnitsCollection::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-unite')
            ->hasConfigFile('unite')
            ->hasTranslations();
    }

    public function packageBooted()
    {
        $this->setupExtraConfigFiles();
    }

    private function setupExtraConfigFiles()
    {
        $this->publishes([
            __DIR__.'/../config/unite' => config_path('unite'),
        ], 'unite-config');
    }
}
