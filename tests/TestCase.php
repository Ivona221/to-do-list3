<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use Illuminate\Contracts\Console\Kernel;
use Mockery;

abstract class TestCase extends BaseTestCase
{
//    use CreatesApplication;

    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        return $app;
    }
    public function gMock($class)
    {
        return Mockery::mock($class);
    }
    public function tearDown() {
        if ($container = Mockery::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }
        Mockery::close();
    }
    public function callRoute($method, $route, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        return $this->call($method, route($route), $parameters, $cookies, $files, $server, $content);
    }
}
