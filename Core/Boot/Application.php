<?php

declare(strict_types=1);

namespace Core\Boot;

use \Core\Boot\AutoLoading;
use \Core\Config\AutoConfigure;
use \Core\Http\Dispatcher;
use \Core\Http\FilterChain;
use \Core\Http\Request;
use \Core\Http\Response;
use \Core\Mvc\View;

if (!class_exists('AutoLoading')) {
    include_once dirname(__DIR__) . '/Boot/AutoLoading.php';
}

class Application
{
    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        AutoLoading::run();

        \Core\Logs\Logger::write(__CLASS__);

        AutoConfigure::run();
    }

    /**
     * @since 1.0.0
     * @return void
     * @throws Throwable
     */
    public function run(): void
    {
        $request = Request::cache();
        $response = Response::cache();

        FilterChain::before($request, $response);

        $dispatcher = new Dispatcher;
        $modelAndView = $dispatcher->handleRequest($request, $response);

        $view = new View($modelAndView, $request, $response);

        FilterChain::after($request, $response);

        $response->send();
    }
}
