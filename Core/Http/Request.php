<?php

declare(strict_types=1);

namespace Core\Http;

class Request
{
    /**
     * @since 1.0.0
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return array_key_exists('REQUEST_METHOD', $_SERVER) ? $_SERVER['REQUEST_METHOD'] : null;
    }

    /**
     * @since 1.0.0
     * @return string|null
     */
    public function getHost(): ?string
    {
        return array_key_exists('HTTP_HOST', $_SERVER) ? $_SERVER['HTTP_HOST'] : null;
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function getUri(): string
    {
        return array_key_exists('REQUEST_URI', $_SERVER) ? $_SERVER['REQUEST_URI'] : '';
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function getPath(): string
    {
        $path = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME);

        return str_replace($path, '', $this->getUri());
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function getPathWithoutQueryString(): string
    {
        $path = $this->getPath();

        return strpos($path, '?') !== false ? (strstr($path, '?', true) ?: '') : $path;
    }

    /**
     * @since 1.0.0
     * @return array<int|string, mixed>
     */
    public function getQueryString(): array
    {
        $schema = parse_url($this->getUri(), PHP_URL_QUERY) ?: '';

        $params = [];

        parse_str($schema, $params);

        return $params ?: [];
    }

    /**
     * @since 1.0.0
     * @return array<string, string>
     */
    public function getHeaders(): array
    {
        if (!function_exists('apache_request_headers')) {
            return [];
        }

        return apache_request_headers() ?: [];
    }

    /**
     * @since 1.0.0
     * @param string $key
     * @return string|null
     */
    public function getHeader(string $key): ?string
    {
        $headers = $this->getHeaders();

        if (array_key_exists($key, $headers)) {
            return $headers[$key];
        }

        return array_key_exists($key, $_SERVER) ? $_SERVER[$key] : null;
    }

    /**
     * @return string|null
     */
    public function getAuthorization(): ?string
    {
        return $this->getHeader('Authorization');
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function getBody(): string
    {
        return file_get_contents('php://input') ?: '';
    }
    /**
     * @since 1.0.0
     * @return boolean
     */
    public function isGet(): bool
    {
        return $this->getMethod() === (Method::GET)->value;
    }

    /**
     * @since 1.0.0
     * @return boolean
     */
    public function isPost(): bool
    {
        return $this->getMethod() === (Method::POST)->value;
    }

    /**
     * @since 1.0.0
     * @return boolean
     */
    public function isDelete(): bool
    {
        return $this->getMethod() === (Method::DELETE)->value;
    }

    /**
     * @since 1.0.0
     * @return boolean
     */
    public function isTrace(): bool
    {
        return $this->getMethod() === (Method::TRACE)->value;
    }

    /**
     * @since 1.0.0
     * @return boolean
     */
    public function isPut(): bool
    {
        return $this->getMethod() === (Method::PUT)->value;
    }

    /**
     * @since 1.0.0
     * @return boolean
     */
    public function isHead(): bool
    {
        return $this->getMethod() === (Method::HEAD)->value;
    }
}
