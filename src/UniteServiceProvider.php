<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Theutz\Unite\Collections\UnitsCollection;
use Theutz\Unite\Definitions\DefinitionLoader;
use Theutz\Unite\Validators\PrefixesValidator;

class UniteServiceProvider extends PackageServiceProvider
{
    public $singletons = [
        DefinitionLoader::class,
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

    public function packageRegistered()
    {
        $this->app
            ->when(PrefixesValidator::class)
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
            __DIR__.'/../config/unite/prefixes.php' => config_path('unite/prefixes.php'),
            __DIR__.'/../config/unite/units.php' => config_path('unite/units.php'),
        ], 'unite-config');
    }

    private function isRunningInTestbench(): bool
    {
        return str(base_path())->contains('testbench-core');
    }
}
