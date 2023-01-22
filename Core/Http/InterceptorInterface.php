<?php

declare(strict_types=1);

namespace Core\Http;

use \Core\Mvc\ModelAndView;

interface InterceptorInterface
{
    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @param string $handler
     * @return void
     * @throws InterceptorExcpetion
     */
    public function preHandle(Request $request, Response $response, string $handler);

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @param object $handler
     * @param ModelAndView $modelAndView
     * @return void
     * @throws InterceptorExcpetion
     */
    public function postHandle(Request $request, Response $response, object $handler, ModelAndView $modelAndView);
}
