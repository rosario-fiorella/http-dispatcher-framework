<?php

declare(strict_types=1);

namespace Core\Utils;

use function _;

use InvalidArgumentException;
use UnexpectedValueException;

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
        if (str_starts_with($uri, 'http') && !filter_var($uri, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(_('error.validation.format.notUri'));
        }

        $this->uri = $uri;
    }

    /**
     * @since 1.0.0
     * @param string $regex
     * @return void
     * @throws UnexpectedValueException
     */
    public function remove(string $regex): void
    {
        $uri = preg_replace($regex, '', $this->uri);

        if ($uri === null) {
            throw new UnexpectedValueException(_('error.uri_filter.remove'));
        }

        $this->uri = $uri;
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
