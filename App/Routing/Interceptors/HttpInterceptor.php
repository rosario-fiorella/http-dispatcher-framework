<?php

declare(strict_types=1);

namespace App\Routing\Filters;

use \Core\Mvc\ModelAndView;
use \Core\Http\InterceptorInterface;
use \Core\Http\InterceptorExcpetion;
use \Core\Http\Request;
use \Core\Http\Response;

class HttpInterceptor implements InterceptorInterface
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
    }
}
