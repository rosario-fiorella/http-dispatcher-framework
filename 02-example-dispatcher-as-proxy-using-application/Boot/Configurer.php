<?php

declare(strict_types=1);

namespace App\Boot;

use \App\Http\Filters\Generic as GenericFilter;
use \App\Http\Interceptors\Generic as GenericInterceptor;
use \Core\Boot\Configurer as __Configurer;
use \Core\Http\Filter as FilterManager;
use \Core\Http\Interceptor as InterceptorManager;

class Configurer extends __Configurer
{
    #[Override]
    public function configureFilter(FilterManager $filter): FilterManager
    {
        $filter->add(new GenericFilter);

        return $filter;
    }

    #[Override]
    public function configureInterceptor(InterceptorManager $interceptor): InterceptorManager
    {
        $interceptor->add(new GenericInterceptor);

        return $interceptor;
    }
}
