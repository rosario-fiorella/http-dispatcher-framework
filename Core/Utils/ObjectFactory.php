<?php

declare(strict_types=1);

namespace Core\Utils;

use function _;

use BadMethodCallException;
use ReflectionClass;
use ReflectionMethod;
use RuntimeException;

class ObjectFactory
{
    /**
     * @since 1.0.0
     * @final
     * @static
     * @param string $namespace
     * @param array<int, mixed> $args
     * @return object
     * @throws RuntimeException
     */
    final public static function getObjectInstance(string $namespace, array $args = []): object
    {
        $reflectionClass = new ReflectionClass($namespace);

        if (!$reflectionClass->isInstantiable()) {
            throw new RuntimeException(_('error.object.notInstantiable'));
        }

        if (!$reflectionClass->hasMethod('__construct')) {
            return $reflectionClass->newInstanceWithoutConstructor();
        }

        $reflectionMethod = new ReflectionMethod($namespace, '__construct');
        if (!$reflectionMethod->isPublic()) {
            return $reflectionClass->newInstanceWithoutConstructor();
        }

        if ($reflectionMethod->getParameters()) {
            return $reflectionClass->newInstanceArgs($args);
        }

        return $reflectionClass->newInstance();
    }

    /**
     * @since 1.0.0
     * @final
     * @static
     * @param object|string $class
     * @param string $method
     * @param array<int, mixed> $args
     * @return mixed
     * @throws BadMethodCallException
     * @throws RuntimeException
     */
    final public static function callObjectMethod(object|string $class, string $method, array $args = []): mixed
    {
        $reflectionClass = new ReflectionClass($class);

        if (!$reflectionClass->hasMethod($method)) {
            throw new BadMethodCallException(_('error.object.method.notFound'));
        }

        $reflectionMethod = new ReflectionMethod($class, $method);
        if (!$reflectionMethod->isPublic()) {
            throw new BadMethodCallException(_('error.object.method.notPublic'));
        }

        if ($reflectionClass->getMethod($method)->isStatic()) {
            return call_user_func_array([$class, $method], $args);
        }

        $instance = null;
        if (is_string($class)) {
            $instance = self::getObjectInstance($class);
        } elseif (is_object($class)) {
            $instance = $class;
        }

        if (!is_object($instance)) {
            throw new RuntimeException(_('error.object.instance.notCreated'));
        }

        return call_user_func_array([$instance, $method], $args);
    }
}
