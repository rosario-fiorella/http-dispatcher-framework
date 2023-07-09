<?php

declare(strict_types=1);

namespace Core\Boot;

use \Core\Context;
use \Core\Http\Dispatcher;
use \Core\Http\Filter;
use \Core\Http\Interceptor;
use \Core\Http\Negotiation;
use \Core\Http\Router;
use \Core\Interfaces\Application;

class Configurer
{
    /**
     * @since 1.0.0
     * @param Application $application
     * @return Application
     */
    public function configureApplication(Application $application): Application
    {
        return $application;
    }

    /**
     * @since 1.0.0
     * @param Dispatcher $dispatcher
     * @return Dispatcher
     */
    public function configureDispatcher(Dispatcher $dispatcher): Dispatcher
    {
        return $dispatcher;
    }

    /**
     * @since 1.0.0
     * @param Router $router
     * @return Router
     */
    public function configureRouter(Router $router): Router
    {
        return $router;
    }

    /**
     * @since 1.0.0
     * @param Negotiation $negotiation
     * @return Negotiation
     */
    public function configureNegotation(Negotiation $negotiation): Negotiation
    {
        $negotiation->header->offsetSet('content-type', [
            'text/html',
            'application/json'
        ]);

        return $negotiation;
    }

    /**
     * @since 1.0.0
     * @param Filter $filter
     * @return Filter
     */
    public function configureFilter(Filter $filter): Filter
    {
        return $filter;
    }

    /**
     * @since 1.0.0
     * @param Interceptor $interceptor
     * @return Interceptor
     */
    public function configureInterceptor(Interceptor $interceptor): Interceptor
    {
        return $interceptor;
    }

    /**
     * @since 1.0.0
     * @param Context $context
     * @param Application $application
     * @param Router $router
     * @return void
     */
    public function configureOnInit(Context $context, Application $application, Router $router): void
    {
        $negotiation = $this->configureNegotation(new Negotiation);

        $filter = $this->configureFilter(new Filter($negotiation));
        $interceptor = $this->configureInterceptor(new Interceptor($negotiation));

        $context->addFilter($filter);
        $context->addInterceptor($interceptor);
        $context->addNegotiation($negotiation);
        $context->addRouter($router);
        $context->addApplication($application);
    }

    /**
     * @since 1.0.0
     * @param Context $context
     * @return void
     */
    public function configureOnShutdown(Context $context): void
    {
    }

    /**
     * @since 1.0.0
     * @param Context $context
     * @return void
     */
    public function configureOnFinalize(Context $context): void
    {
    }
}
