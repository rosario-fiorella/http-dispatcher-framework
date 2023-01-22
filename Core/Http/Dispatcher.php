<?php

declare(strict_types=1);

namespace Core\Http;

use \Core\Mvc\ModelAndView;
use \Core\Utils\ObjectFactory;

class Dispatcher
{
    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        \Core\Logs\Logger::write(__CLASS__);
    }

    /**
     * @since 1.0.0
     * @param \Core\Http\Request $request
     * @param \Core\Http\Response $response
     * @return \Core\Mvc\ModelAndView
     * @throws \Core\Http\RouterException
     * @throws \Core\Http\InterceptorExcpetion
     */
    public function handleRequest(Request $request, Response $response): ModelAndView
    {
        $controller = (new Router)->handle();

        $interceptor = new Interceptor;
        $interceptor->preHandle($request, $response, $controller);

        $controllerObj = ObjectFactory::getObjectInstance($controller);
        $modelAndView = ObjectFactory::callObjectMethod($controller, 'handleRequest', $request, $response);

        $interceptor->postHandle($request, $response, $controllerObj, $modelAndView);

        return $modelAndView;
    }
}
