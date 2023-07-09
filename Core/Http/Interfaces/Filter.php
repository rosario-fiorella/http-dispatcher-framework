<?php

declare(strict_types=1);

namespace Core\Http\Interfaces;

use \Core\Http\Negotiation;
use \Core\Http\Request;
use \Core\Http\Response;

interface Filter
{
    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function init(Request $request, Response $response, Negotiation $negotiation): void;

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function destroy(Request $request, Response $response, Negotiation $negotiation): void;
}
