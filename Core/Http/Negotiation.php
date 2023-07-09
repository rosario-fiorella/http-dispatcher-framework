<?php

declare(strict_types=1);

namespace Core\Http;

use \Core\Http\Negotiation\Header;
use \Core\Http\Negotiation\Body;

class Negotiation
{
    /**
     * @since 1.0.0
     * @readonly
     * @var Header $header
     */
    public readonly Header $header;

    /**
     * @since 1.0.0
     * @readonly
     * @var Body $body
     */
    public readonly Body $body;

    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->header = new Header;
        $this->body = new body;
    }
}
