<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Theutz\Unite\Collections\UnitsCollection;
use Theutz\Unite\Definitions\DefinitionLoader;
use Theutz\Unite\Loaders\Prefixes;
use Theutz\Unite\Loaders\Units;
use Theutz\Unite\Validators\ConfigValidator;

class UniteServiceProvider extends PackageServiceProvider
{
    public $singletons = [
        Units::class,
        Prefixes::class,
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

        $this->validateConfig();
    }

    private function setupExtraConfigFiles()
    {
        $this->publishes([
            __DIR__.'/../config/unite' => config_path('unite'),
        ], 'unite-config');
    }

    private function validateConfig()
    {
        if (config('app.env') !== 'production') {
            app(ConfigValidator::class)->validate();
        }
    }
}
