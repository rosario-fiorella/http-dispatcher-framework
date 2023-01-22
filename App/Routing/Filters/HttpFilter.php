<?php

declare(strict_types=1);

namespace App\Routing\Filters;

use \Core\Http\FilterException;
use \Core\Http\FilterInterface;
use \Core\Http\Request;
use \Core\Http\Response;

class HttpFilter implements FilterInterface
{
    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     * @throws FilterException
     */
    public static function before(Request $request, Response $response): void
    {
        \Core\Logs\Logger::write(__CLASS__ . ' ' . __METHOD__);

        if (!$request->getHeader('HTTP_CONNECTION')) {
            throw new FilterException('error.http.connection');
        }
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     * @throws FilterException
     */
    public static function after(Request $request, Response $response): void
    {
        \Core\Logs\Logger::write(__CLASS__ . ' ' . __METHOD__);
    }
}
