<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Theutz\Unite\Concerns\Formatter\Formatter;
use Theutz\Unite\Concerns\Manager\Manager;
use Theutz\Unite\Concerns\Parser\Parser;
use Theutz\Unite\Concerns\Formatter\FormatterInterface;
use Theutz\Unite\Concerns\Parser\ParserInterface;
use Theutz\Unite\Concerns\Manager\ManagerInterface;

class UniteServiceProvider extends PackageServiceProvider
{
    public $bindings = [
        ParserInterface::class => Parser::class,
        ManagerInterface::class => Manager::class
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
