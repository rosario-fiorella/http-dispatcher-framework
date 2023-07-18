<?php

declare(strict_types=1);

namespace Core\Utils;

use function \_;
use InvalidArgumentException;

class URIFilter
{
    /**
     * @since 1.0.0
     * @access protected
     * @var string $uri
     */
    protected string $uri;

    /**
     * @since 1.0.0
     * @param string $uri
     * @throws InvalidArgumentException
     */
    public function __construct(string $uri)
    {
        if (filter_var($uri, FILTER_VALIDATE_URL) && !preg_match('/[^\w.-]/', $uri)) {
            throw new InvalidArgumentException(_('error.validation.format.notUri'));
        }

        $this->uri = $uri;
    }

    /**
     * @since 1.0.0
     * @param string $regex
     * @return void
     */
    public function remove(string $regex): void
    {
        $this->uri = preg_replace($regex, '', $this->uri);
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }
}
