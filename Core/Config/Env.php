<?php

declare(strict_types=1);

namespace Core\Config;

use \Core\Utils\SingletonTrait;

class Env
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
     * @access protected
     * @var null|array<string, mixed> $env
     */
    protected static ?array $env = null;

    /**
     * @since 1.0.0
     * @access protected
     */
    protected function __construct()
    {
        \Core\Logs\Logger::write(__CLASS__);

        if (static::$env !== null) {
            return;
        }

        $env = $this->resolveFilename();

        static::$env = $env ? (parse_ini_file($env) ?: []) : [];

        $this->map();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    protected function map(): void
    {
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return string|null
     */
    protected function resolveFilename(): ?string
    {
        $env = [
            0 => 'local.env',
            1 => 'dev.env',
            2 => 'staging.env',
            3 => 'test.env',
            4 => 'demo.env',
            5 => 'prod.env'
        ];

        foreach ($env as $file) {
            if (file_exists($file)) {
                return $file;
            }
        }

        return null;
    }

    /**
     * @since 1.0.0
     * @param string $key
     * @param string $default
     * @return string
     */
    final public static function get(string $key, string $default = ''): string
    {
        if (array_key_exists($key, $_ENV)) {
            return $_ENV[$key];
        }

        if (static::$env && array_key_exists($key, static::$env)) {
            return static::$env[$key];
        }

        return (getenv($key) ?: $default);
    }

    /**
     * @since 1.0.0
     * @return array
     */
    final public static function getAll(): array
    {
        return static::$env ?: [];
    }
}
