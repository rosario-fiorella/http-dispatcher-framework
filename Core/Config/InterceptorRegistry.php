<?php

declare(strict_types=1);

namespace Core\Config;

class InterceptorRegistry extends ServiceRegistry
{
    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        \Core\Logs\Logger::write(__CLASS__);
    }
}
