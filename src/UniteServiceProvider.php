<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Theutz\Unite\Data\Finder;
use Theutz\Unite\Intl\NumberParser;

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

    public function packageRegistered()
    {
        $this->app->when(NumberParser::class)
            ->needs('$locale')
            ->giveConfig('app.locale');

        $this->registerModels();
    }

    private function registerModels(): void
    {
        foreach ($this->app->make(Finder::class)->find() as $className) {
            $this->app->singleton($className);
        }
    }
}
