<?php

declare(strict_types=1);

namespace Core\Http;

use Core\Config\FilterRegistry;
use \Core\Utils\ObjectFactory;

class FilterChain
{
    /**
     * @since 1.0.0
     * @param \Core\Http\Request $request
     * @param \Core\Http\Response $response
     * @return void
     * @throws \Core\Http\FilterException
     */
    public static function before(\Core\Http\Request $request, \Core\Http\Response $response): void
    {
        \Core\Logs\Logger::write(__CLASS__ . ' ' . __METHOD__);

        foreach (FilterRegistry::list() as $ns) {
            ObjectFactory::callObjectMethod($ns, 'before', $request, $response);
        }
    }

    /**
     * @since 1.0.0
     * @param \Core\Http\Request $request
     * @param \Core\Http\Response $response
     * @return void
     * @throws \Core\Http\FilterException
     */
    public static function after(\Core\Http\Request $request, \Core\Http\Response $response): void
    {
        \Core\Logs\Logger::write(__CLASS__ . ' ' . __METHOD__);

        foreach (FilterRegistry::list() as $ns) {
            ObjectFactory::callObjectMethod($ns, 'after', $request, $response);
        }
    }
}
