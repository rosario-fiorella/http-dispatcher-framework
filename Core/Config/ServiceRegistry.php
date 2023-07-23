<?php

declare(strict_types=1);

namespace Core\Config;

use \InvalidArgumentException;

class ServiceRegistry
{
    /**
     * @since 1.0.0
     * @access protected
     * @var string[] $list
     */
    protected static array $list = [];

    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        \Core\Logs\Logger::write(__CLASS__);
    }

    /**
     * @since 1.0.0
     * @param string $class
     * @return void
     * @throws InvalidArgumentException
     */
    public function registry(string $class): void
    {
        if (!class_exists($class)) {
            throw new InvalidArgumentException('error.class.notFound');
        }

        $this->list[] = $class;
    }

    /**
     * @since 1.0.0
     * @param string $class
     * @return void
     */
    public function deregister(string $class): void
    {
        $this->list = array_filter($this->list, function ($ns) use ($class) {
            return $ns !== $class;
        });
    }

    /**
     * @since 1.0.0
     * @param string $class
     * @return bool
     */
    public function contains(string $class): bool
    {
        return in_array($class, $this->list);
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function clear(): void
    {
        $this->list = [];
    }

    /**
     * @since 1.0.0
     * @return string[]
     */
    public static function list(): array
    {
        return static::$list;
    }
}
