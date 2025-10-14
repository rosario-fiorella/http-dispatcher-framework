<?php

declare(strict_types=1);

namespace App\Http\Interceptors;

use Core\Http\Controller;
use Core\Http\Interfaces\Interceptor as InterceptorInterface;
use Core\Http\ModelAndView;
use Core\Http\Negotiation;
use Core\Http\Request;
use Core\Http\Response;

class Generic implements InterceptorInterface
{
    public function preHandle(Request $request, Response $response, string $handler, Negotiation $negotiation): void {}

    public function postHandle(Request $request, Response $response, Controller $handler, ModelAndView $modelAndView, Negotiation $negotiation): void
    {
        $response->setHeader('Content-Security-Policy', "script-src 'self' https://cdnjs.cloudflare.com 'nonce-123456' 'unsafe-eval';");
    }
}
