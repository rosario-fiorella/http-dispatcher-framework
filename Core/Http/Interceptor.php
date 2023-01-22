<?php

declare(strict_types=1);

namespace Core\Http;

use \Core\Config\InterceptorRegistry;
use \Core\Utils\ObjectFactory;
use \Core\Mvc\ModelAndView;

class Interceptor implements InterceptorInterface
{
    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @param string $handler
     * @return void
     * @throws InterceptorExcpetion
     */
    public function preHandle(Request $request, Response $response, string $handler)
    {
        \Core\Logs\Logger::write(__CLASS__ . ' ' . __METHOD__);

        foreach (InterceptorRegistry::list() as $ns) {
            ObjectFactory::getObjectInstance($ns, $request, $response, $handler);
        }
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @param object $handler
     * @param ModelAndView $modelAndView
     * @return void
     * @throws InterceptorExcpetion
     */
    public function postHandle(Request $request, Response $response, object $handler, ModelAndView $modelAndView)
    {
        \Core\Logs\Logger::write(__CLASS__ . ' ' . __METHOD__);

        foreach (InterceptorRegistry::list() as $ns) {
            ObjectFactory::getObjectInstance($ns, $request, $response, $handler, $modelAndView);
        }
    }
}
