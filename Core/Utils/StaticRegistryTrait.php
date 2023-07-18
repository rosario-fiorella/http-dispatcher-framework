<?php

declare(strict_types=1);

namespace Core\Utils;

use function \_;
use \Traversable;
use \ArrayIterator;
use \InvalidArgumentException;

trait StaticRegistryTrait
{
    /**
     * @since 1.0.0
     * @static
     * @access protected
     * @var array<string, string> $map
     */
    protected static $map = [];

    /**
     * @since 1.0.0
     * @param string $key
     * @return string
     * @throws InvalidArgumentException
     */
    public function get(string $key): string
    {
        if ($this->isset($key)) {
            return (static::$map)[$key];
        }

        throw new InvalidArgumentException(_('error.array.key.notFound'));
    }

    /**
     * @since 1.0.0
     * @param string $key
     * @param string $value
     * @return void
     */
    public function set(string $key, string $value): void
    {
        static::$map[$key] = $value;
    }

    /**
     * @since 1.0.0
     * @param string $key
     * @return void
     */
    public function unset(string $key): void
    {
        if ($this->isset($key)) {
            unset(static::$map[$key]);
        }
    }

    /**
     * @since 1.0.0
     * @param string $key
     * @return bool
     */
    public function isset(string $key): bool
    {
        return array_key_exists($key, static::$map);
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function clear(): void
    {
        static::$map = [];
    }

    /**
     * @since 1.0.0
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator(static::$map);
    }
}
