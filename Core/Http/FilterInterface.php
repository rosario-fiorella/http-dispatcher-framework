<?php

declare(strict_types=1);

namespace Core\Http;

interface FilterInterface
{
    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     * @throws FilterException
     */
    public static function before(Request $request, Response $response): void;

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     * @throws FilterException
     */
    public static function after(Request $request, Response $response): void;
}
