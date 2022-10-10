<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Theutz\Unite\Formatter\Formatter;
use Theutz\Unite\Formatter\FormatterInterface;
use Theutz\Unite\Manager\Manager;
use Theutz\Unite\Manager\ManagerInterface;
use Theutz\Unite\Parser\Parser;
use Theutz\Unite\Parser\ParserInterface;

class UniteServiceProvider extends PackageServiceProvider
{
    public $bindings = [
        ParserInterface::class => Parser::class,
        ManagerInterface::class => Manager::class,
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
        $this->app->singleton(FormatterInterface::class, function () {
            return new Formatter;
        });
    }
}
