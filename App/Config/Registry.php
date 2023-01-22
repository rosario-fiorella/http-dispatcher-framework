<?php

declare(strict_types=1);

namespace App\Config;

use \App\Routing\Filters\HttpFilter;
use \App\Routing\Filters\HttpInterceptor;
use \Core\Config\FilterRegistry;
use \Core\Config\InterceptorRegistry;

class Registry
{
    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        \Core\Logs\Logger::write(__CLASS__ . ' ' . __METHOD__);

        $filterRegistry = new FilterRegistry;
        $filterRegistry->registry(HttpFilter::class);

        $interceptorRegistry = new InterceptorRegistry;
        $interceptorRegistry->registry(HttpInterceptor::class);
    }
}
