<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Theutz\Unite\Models\Prefix;
use Theutz\Unite\Models\System;
use Theutz\Unite\Models\Unit;
use Theutz\Unite\Models\Kind;

class UniteServiceProvider extends PackageServiceProvider
{
    public $singletons = [
        Unit::class,
        Prefix::class,
        System::class,
        Kind::class
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
            ->hasConfigFile()
            ->hasTranslations();
    }
}
