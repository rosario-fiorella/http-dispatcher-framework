<?php

declare(strict_types=1);

namespace Core\Http\Interfaces;

use Core\Http\Controller;
use Core\Http\ModelAndView;
use Core\Http\Negotiation;
use Core\Http\Request;
use Core\Http\Response;

interface Interceptor
{
    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @param string $handler
     * @return void
     */
    public function preHandle(Request $request, Response $response, string $handler, Negotiation $negotiation): void;

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @param Controller $handler
     * @param ModelAndView $modelAndView
     * @return void
     */
    public function postHandle(Request $request, Response $response, Controller $handler, ModelAndView $modelAndView, Negotiation $negotiation): void;
}
