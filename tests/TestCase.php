<?php

namespace TNM\VXView\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use TNM\VXView\VXViewServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(realpath(__DIR__.'/../src/database/migrations'));
    }

    protected function getPackageProviders($app): array
    {
        return [
            VXViewServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
    }
}
