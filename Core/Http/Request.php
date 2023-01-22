<?php

declare(strict_types=1);

namespace Core\Http;

use \Core\Utils\SingletonTrait;

class Request
{
    /**
     * @since 1.0.0
     */
    use SingletonTrait {
        __construct as super;
        run as cache;
    }

    /**
     * @since 1.0.0
     * @return void
     */
    protected function __construct()
    {
        \Core\Logs\Logger::write(__CLASS__);
    }

    /**
     * @since 1.0.0
     * @return null|string
     */
    public function getMethod(): ?string
    {
        return array_key_exists('REQUEST_METHOD', $_SERVER) ? $_SERVER['REQUEST_METHOD'] : null;
    }

    /**
     * @since 1.0.0
     * @return null|string
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
        return strpos($path, '?') !== false ? strstr($path, '?', true) : $path;
    }

    /**
     * @since 1.0.0
     * @return array
     */
    public function getQueryString(): array
    {
        $schema = parse_url($this->getUri());
        parse_str($schema['query'], $params);

        return $params ?: [];
    }

    /**
     * @since 1.0.0
     * @return array
     */
    public function getHeaders(): array
    {
        return apache_request_headers() ?: [];
    }

    /**
     * @since 1.0.0
     * @param string $key
     * @return null|string
     */
    public function getHeader(string $key): ?string
    {
        if (array_key_exists($key, $this->getHeaders())) {
            return $this->getHeaders()[$key];
        }

        return array_key_exists($key, $_SERVER) ? $_SERVER[$key] : null;
    }

    /**
     * @since 1.0.0
     * @param string $type
     * @return void
     */
    public function getAuthorization()
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
}
