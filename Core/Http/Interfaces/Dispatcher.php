<?php

declare(strict_types=1);

namespace Core\Http\Interfaces;

use Core\Http\Response;
use Core\Http\Request;

interface Dispatcher
{
    /**
     * @since 1.0.0
     * @return void
     */
    public function init(): void;

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function service(Request $request, Response $response): void;

    /**
     * @since 1.0.0
     * @return void
     */
    public function destroy(): void;
}
