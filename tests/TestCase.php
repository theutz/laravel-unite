<?php

namespace Theutz\Unite\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;
use Theutz\Unite\Database\Seeders\UniteSeeder;
use Theutz\Unite\UniteServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected $seed = true;

    protected $seeder = UniteSeeder::class;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Theutz\\Unite\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            UniteServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../database/migrations/create_unite_tables.php.stub';
        $migration->up();
    }
}
