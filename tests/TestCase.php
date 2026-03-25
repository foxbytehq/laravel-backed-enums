<?php

namespace Foxbytehq\LaravelBackedEnums\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Foxbytehq\LaravelBackedEnums\LaravelBackedEnumsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelBackedEnumsServiceProvider::class,
        ];
    }

    public static function applicationBasePath(): string
    {
        return __DIR__.'/../workbench';
    }
}
