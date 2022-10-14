<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Theutz\Unite\Data\Finder;

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
        foreach ($this->app->make(Finder::class)->find() as $className) {
            $this->app->singleton($className);
        }
    }
}
