<?php

namespace LemonSqueezy\PlainUiComponents\Tests;

use LemonSqueezy\PlainUiComponents\PlainUiComponentsServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            PlainUiComponentsServiceProvider::class,
        ];
    }
}
