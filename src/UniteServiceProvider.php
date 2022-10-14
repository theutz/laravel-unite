<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Composer\ClassMapGenerator\ClassMapGenerator;

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
        $this->registerModels();
    }

    private function registerModels() {
        $map = ClassMapGenerator::createMap(__DIR__.'/Models');

        foreach ($map as $className => $path) {
            $this->app->singleton($className);
        }
    }
}
