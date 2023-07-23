<?php

declare(strict_types=1);

namespace Core\Config;

use \JsonSerializable;
use \RuntimeException;

class TemplateEngine implements JsonSerializable
{
    /**
     * @since 1.0.0
     * @var object|null $data
     */
    protected ?object $data = null;

    /**
     * @since 1.0.0
     * @param object|null $data
     */
    public function __construct(?object $data = null)
    {
        $this->data = $data;
    }

    /**
     * @since 1.0.0
     * @return string
     * @throws RuntimeException
     */
    public function jsonSerialize(): string
    {
        $json = json_encode($this->data ?? '');

        if (json_last_error()) {
            throw new RuntimeException(json_last_error_msg(), json_last_error());
        }

        return $json;
    }
}
