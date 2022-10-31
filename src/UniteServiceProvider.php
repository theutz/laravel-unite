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
            ->hasConfigFile('unite')
            ->hasTranslations();
        $this->configureDefinitions();
    }

    public function packageBooted()
    {
        $this->registerPrivatePackageCommands();
    }

    private function configureDefinitions()
    {
        $definintions = collect([
            __DIR__.'/../config/unite-prefixes.php' => 'unite-prefixes',
            __DIR__.'/../config/unite-units.php' => 'unite-units',
        ]);

        // Register files for publishing
        $publishes = $definintions
            ->map(fn ($configKey) => config_path("{$configKey}.php"))->all();

        $this->publishes($publishes, 'unite-config');

        // Read from published files instead of package files, if they've been
        // published. This is in contrast to the more default behavior
        // of merging values in.
        $definintions
            ->each(function ($configKey, $configPath) {
                if (! file_exists(config_path($configKey.'.php'))) {
                    config([$configKey => require $configPath]);
                }
            });
    }

    private function registerPrivatePackageCommands(): void
    {
        if (
            $this->isRunningInTestbench() &&
            $this->app->runningInConsole()
        ) {
            $this->commands([
                GenerateLangFiles::class,
            ]);
        }
    }

    private function isRunningInTestbench(): bool
    {
        return str(base_path())->contains('testbench-core');
    }
}
