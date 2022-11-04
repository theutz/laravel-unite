<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Theutz\Unite\Collections\Conversions;
use Theutz\Unite\Collections\Prefixes;
use Theutz\Unite\Collections\Units;

class UniteServiceProvider extends PackageServiceProvider
{
    public $singletons = [
        Units::class,
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

    public function packageRegistered(): void
    {
        $this->app->when(Units::class)
            ->needs('$units')
            ->giveConfig('unite.units');
        $this->app->when(Conversions::class)
            ->needs('$conversions')
            ->giveConfig('unite.conversions');
        $this->app->when(Prefixes::class)
            ->needs('$prefixes')
            ->giveConfig('unite.prefixes');
    }

    public function packageBooted()
    {
        $this->setupExtraConfigFiles();
    }

    private function setupExtraConfigFiles()
    {
        $this->publishes([
            __DIR__ . '/../config/unite' => config_path('unite'),
        ], 'unite-config');
    }
}
