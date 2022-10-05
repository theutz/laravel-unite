<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Theutz\Unite\Concerns\Formatter\Formatter;
use Theutz\Unite\Concerns\Manager\Manager;
use Theutz\Unite\Concerns\Parser\Parser;
use Theutz\Unite\Contracts\Formatter as FormatterContract;
use Theutz\Unite\Contracts\Parser as ParserContract;
use Theutz\Unite\Contracts\Manager as ManagerContract;

class UniteServiceProvider extends PackageServiceProvider
{
    public $bindings = [
        ParserContract::class => Parser::class,
        ManagerContract::class => Manager::class
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

    public function packageRegistered()
    {
        $this->app->singleton(FormatterContract::class, function () {
            return new Formatter;
        });
    }
}
