<?php

declare(strict_types=1);

namespace App\Config;

class Debug
{
    public function __construct(string $debug = '1')
    {
        if ($debug === '1') {
            error_reporting(E_ALL);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        }

        ini_set('display_errors', $debug);
        ini_set('display_startup_errors', $debug);
    }
}
