<?php

declare(strict_types=1);

namespace Core;

use \core\Boot\Loader;
use \core\Boot\Registry;
use \Core\Http\Filter;
use \Core\Http\Interceptor;
use \Core\Http\Interfaces\Dispatcher;
use \Core\Http\Negotiation;
use \Core\Http\Response;
use \Core\Http\Request;
use \Core\Http\Router;
use \Core\Interfaces\Application;

class Context
{
    /**
     * @since 1.0.0
     * @access protected
     * @var Application $application
     */
    protected Application $application;

    /**
     * @since 1.0.0
     * @access protected
     * @var Dispatcher $dispatcher
     */
    protected Dispatcher $dispatcher;

    /**
     * @since 1.0.0
     * @access protected
     * @var Filter $filter
     */
    protected Filter $filter;

    /**
     * @since 1.0.0
     * @access protected
     * @var Interceptor $interceptor
     */
    protected Interceptor $interceptor;

    /**
     * @since 1.0.0
     * @access protected
     * @var Loader $loader
     */
    protected Loader $loader;

    /**
     * @since 1.0.0
     * @access protected
     * @var Negotiation $negotiation
     */
    protected Negotiation $negotiation;


    /**
     * @since 1.0.0
     * @access protected
     * @var Registry $registry
     */
    protected Registry $registry;

    /**
     * @since 1.0.0
     * @access protected
     * @var Router $router
     */
    protected Router $router;

    /**
     * @since 1.0.0
     * @param Registry $registry
     * @param Loader $loader
     */
    public function __construct(Registry $registry, Loader $loader)
    {
        $this->registry = $registry;
        $this->loader = $loader;
    }

    /**
     * @since 1.0.0
     * @param Application $application
     * @return void
     */
    public function addApplication(Application $application): void
    {
        $this->application = $application;
    }

    /**
     * @since 1.0.0
     * @param Dispatcher $dispatcher
     * @return void
     */
    public function addDispatcher(Dispatcher $dispatcher): void
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @since 1.0.0
     * @param Filter $filter
     * @return void
     */
    public function addFilter(Filter $filter): void
    {
        $this->filter = $filter;
    }

    /**
     * @since 1.0.0
     * @param Interceptor $interceptor
     * @return void
     */
    public function addInterceptor(Interceptor $interceptor): void
    {
        $this->interceptor = $interceptor;
    }

    /**
     * @since 1.0.0
     * @param Negotiation $negotiation
     * @return void
     */
    public function addNegotiation(Negotiation $negotiation): void
    {
        $this->negotiation = $negotiation;
    }

    /**
     * @since 1.0.0
     * @param Router $router
     * @return void
     */
    public function addRouter(Router $router): void
    {
        $this->router = $router;
    }

    /**
     * @since 1.0.0
     * @return Filter
     */
    public function getFilter(): Filter
    {
        return $this->filter;
    }

    /**
     * @since 1.0.0
     * @return Dispatcher
     */
    public function getDispatcher(): Dispatcher
    {
        return $this->dispatcher;
    }

    /**
     * @since 1.0.0
     * @return Interceptor
     */
    public function getInterceptor(): Interceptor
    {
        return $this->interceptor;
    }

    /**
     * @since 1.0.0
     * @return Loader
     */
    public function getLoader(): Loader
    {
        return $this->loader;
    }

    /**
     * @since 1.0.0
     * @return Registry
     */
    public function getRegistry(): Registry
    {
        return $this->registry;
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function initDispatch(Request $request, Response $response): void
    {
        $this->dispatcher = $this->router->getDispatcher($request);
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function preDispatch(Request $request, Response $response): void
    {
        $this->filter->init($request, $response);

        $this->dispatcher->init();
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function doDispatch(Request $request, Response $response): void
    {
        $this->dispatcher->service($request, $response);
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function postDispatch(Request $request, Response $response): void
    {
        $this->filter->destroy($request, $response);

        $this->dispatcher->destroy();
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function shutdownDispatch(Request $request, Response $response): void
    {
        mb_http_output('UTF-8');
        if (!ob_start('ob_gzhandler')) {
            ob_start('mb_output_handler');
        }

        ob_implicit_flush(true);
        ob_clean();

        $response->send();

        ob_flush();

        if (!in_array('ob_gzhandler', ob_list_handlers())) {
            ob_end_flush();
            ob_end_clean();
        }
    }
}
