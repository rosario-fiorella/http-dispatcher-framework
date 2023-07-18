<?php

declare(strict_types=1);

namespace App\Boot;

use \App\Controllers\Generic;
use \App\Controllers\User;
use \Core\Boot\Configurer;
use \Core\Boot\Initializer as __Initializer;
use \Core\Context;
use \Core\Http\Router;

class Initializer extends __Initializer
{
    /**
     * @since 1.0.0
     * @param Context $context
     * @param Configurer $configurer
     */
    public function __construct(Context $context, Configurer $configurer)
    {
        $generic = $configurer->configureDispatcher(new Generic);
        $user = $configurer->configureDispatcher(new User);

        $router = $configurer->configureRouter(new Router);
        $router->addDispatcher('/user\/(\d+)/', $user);
        $router->addDispatcher('/(.+)/', $generic);

        $configurer->configureOnInit($context, $router);
    }
}
