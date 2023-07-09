<?php

declare(strict_types=1);

namespace Core\Utils;

use \JsonException;
use \JsonSerializable;

class ObjectSerializable implements JsonSerializable
{
    /**
     * @since 1.0.0
     * @access protected
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
     * @throws JsonException
     */
    public function jsonSerialize(): string
    {
        if (!$this->data) {
            return '';
        }

        $json = json_encode($this->data);

        if (json_last_error()) {
            throw new JsonException(json_last_error_msg(), json_last_error());
        }

        return $json;
    }
}
