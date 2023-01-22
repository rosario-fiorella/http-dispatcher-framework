<?php

declare(strict_types=1);

namespace Core\Http;

class Header
{
    /**
     * @since 1.0.0
     * @access protected
     * @var array<string, mixed>
     */
    protected array $headers = [];

    /**
     * @since 1.0.0
     * @param string $key
     * @param string $value
     * @return void
     */
    public function set(string $key, string $value): void
    {
        $key = htmlentities($key);
        if (strtolower($key) === 'location' || filter_var($value, FILTER_VALIDATE_URL) !== false) {
            $value = urlencode(htmlentities($value));
        } else {
            $value = htmlentities($value);
        }

        $this->headers[$key] = $value;
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function add(): void
    {
        foreach ($this->headers as $k => $v) {
            header(sprintf('%s: %s',  $k, $v), true);
        }

        $this->clear();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function clear(): void
    {
        $this->headers = [];
    }
}
