<?php

namespace CodeBugLab\Enver\Tests;

use CodeBugLab\Enver\EnverServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            EnverServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app->useEnvironmentPath(__DIR__ . '/..');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);

        parent::getEnvironmentSetUp($app);
    }
}
