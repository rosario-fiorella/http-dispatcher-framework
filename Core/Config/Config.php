<?php

declare(strict_types=1);

namespace Core\Config;

use \Core\Utils\SingletonTrait;

class Config
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
     * @var null|array<string, mixed> $config
     */
    protected static ?array $config = null;

    /**
     * @since 1.0.0
     * @access protected
     */
    protected function __construct()
    {
        \Core\Logs\Logger::write(__CLASS__);

        if (static::$config !== null) {
            return;
        }

        $ini = $this->resolveFilename();

        static::$config = $ini ? (parse_ini_file($ini) ?: []) : [];

        $this->map();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    protected function map(): void
    {
        $env = Env::cache()->getAll();

        $envKeys = [];
        $envValues = [];
        foreach ($env as $k => $v) {
            $envKeys[] = sprintf('{{env:%s}}', $k);
            $envValues[] = $v;
        }

        $configKeys = [];
        $configValues = [];
        foreach ($this->getAll() as $k => $v) {
            $configKeys[] = sprintf('{{config:%s}}', $k);
            $configValues[] = $v;
        }

        static::$config = str_replace($envKeys, $envValues, static::$config);
        static::$config = str_replace($configKeys, $configValues, static::$config);
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return string|null
     */
    protected function resolveFilename(): ?string
    {
        $ini = [
            0 => 'local.ini',
            1 => 'dev.ini',
            2 => 'staging.ini',
            3 => 'test.ini',
            4 => 'demo.ini',
            5 => 'prod.ini'
        ];

        foreach ($ini as $file) {
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
        return static::$config && array_key_exists($key, static::$config) ? static::$config[$key] : $default;
    }

    /**
     * @since 1.0.0
     * @return array
     */
    final public static function getAll(): array
    {
        return static::$config ?: [];
    }
}
