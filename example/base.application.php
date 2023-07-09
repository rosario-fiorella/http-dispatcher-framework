<?php

include_once __DIR__ . '/base.config.php';

use \Core\Http\Request;
use \Core\Http\Response;
use \Core\Interfaces\Application as ApplicationInterface;

class Application implements ApplicationInterface
{
    public function init(): void
    {
    }

    public function preHandle(Request $request, Response $response): void
    {
    }

    public function doHandle(Request $request, Response $response): void
    {
    }

    public function postHandle(Request $request, Response $response): void
    {
        $response->setBody(
            sprintf(
                '<h1>FRONT CONTROLLER FRAMEWORK</h1><p><a href="https://it.wikipedia.org/wiki/Front_Controller_pattern" target="_blank">more info</a></p><p>Rendering time: %s seconds</p>',
                number_format(microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 3)
            )
        );
    }

    public function render(): void
    {
    }

    public function destroy(): void
    {
    }
}
