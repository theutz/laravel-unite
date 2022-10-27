<?php

namespace Theutz\Unite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Theutz\Unite\Collections\UnitsCollection;
use Theutz\Unite\Commands\GenerateLangFiles;
use Theutz\Unite\Definitions\DefinitionLoader;

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
            ->hasConfigFile()
            ->hasTranslations();
    }

    public function packageBooted()
    {
        $this->registerPrivatePackageCommands();
    }

    private function registerPrivatePackageCommands(): void
    {
        $isInTestBench = str(base_path())->contains('testbench-core');

        if ($isInTestBench && $this->app->runningInConsole()) {
            $this->commands([
                GenerateLangFiles::class,
            ]);
        }
    }
}
