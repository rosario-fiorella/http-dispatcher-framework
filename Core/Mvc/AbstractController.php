<?php

declare(strict_types=1);

namespace Core\Mvc;

use \Core\Http\Request;
use \Core\Http\Response;
use \Core\Utils\ObjectSupport;

abstract class AbstractController extends ObjectSupport
{
    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return ModelAndView
     */
    abstract public function handleRequest(Request $request, Response $response): ModelAndView;
}
