<?php

declare(strict_types=1);

namespace Core\Interfaces;

use \Core\Http\Response;
use \Core\Http\Request;

interface Application
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
    public function preHandle(Request $request, Response $response): void;

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function doHandle(Request $request, Response $response): void;

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function postHandle(Request $request, Response $response): void;

    /**
     * @since 1.0.0
     * @return void
     */
    public function render(): void;

    /**
     * @since 1.0.0
     * @return void
     */
    public function destroy(): void;
}
