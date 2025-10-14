<?php

declare(strict_types=1);

namespace App\Boot;

use App\Http\Filters\Generic as GenericFilter;
use App\Http\Interceptors\Generic as GenericInterceptor;
use Core\Boot\Configurer as __Configurer;
use Core\Http\Filter as __Filter;
use Core\Http\Interceptor as __Interceptor;

class Configurer extends __Configurer
{
    public function configureFilter(__Filter $filter): __Filter
    {
        $filter->add(new GenericFilter());

        return $filter;
    }

    public function configureInterceptor(__Interceptor $interceptor): __Interceptor
    {
        $interceptor->add(new GenericInterceptor());

        return $interceptor;
    }
}
