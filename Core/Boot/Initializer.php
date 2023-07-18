<?php

declare(strict_types=1);

namespace Core\Boot;

use \Core\Context;
use \Core\Http\Dispatcher;
use \Core\Http\Router;
use \Core\Utils\ObjectStorage;

class Initializer
{
    /**
     * @since 1.0.0
     * @param Context $context
     * @param Configurer $configurer
     */
    public function __construct(Context $context, Configurer $configurer)
    {
        $locator = new ObjectStorage($context->getRegistry(), $context->getLoader(), $configurer);

        $application = $locator->instanceApplication([$context]);

        $dispatcher = $configurer->configureDispatcher(new Dispatcher($application));

        $router = $configurer->configureRouter(new Router);
        $router->addDispatcher('/(.+)/', $dispatcher);

        $configurer->configureOnInit($context, $router, $application);
    }
}
