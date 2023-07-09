<?php

declare(strict_types=1);

namespace Core\Utils;

use \LogicException;
use \ReflectionClass;
use \ReflectionMethod;

class ObjectFactory
{
    /**
     * @since 1.0.0
     * @final
     * @param string $namespace
     * @param mixed ...$args
     * @return object
     */
    final public static function getObjectInstance(string $namespace, mixed ...$args): mixed
    {
        $reflectionClass = new ReflectionClass($namespace);
        if (!$reflectionClass->hasMethod('__construct')) {
            return $reflectionClass->newInstanceWithoutConstructor();
        }

        $reflectionMethod = new ReflectionMethod($reflectionClass->getName(), '__construct');
        if ($reflectionMethod->getParameters()) {
            return $reflectionClass->newInstance(...$args);
        }

        return $reflectionClass->newInstance();
    }

    /**
     * @since 1.0.0
     * @final
     * @param mixed $class
     * @param string $method
     * @param mixed ...$args
     * @return mixed
     * @throws LogicException
     */
    final public static function callObjectMethod(mixed $class, string $method, mixed ...$args): mixed
    {
        $reflectionClass = new ReflectionClass($class);

        if (!$reflectionClass->hasMethod($method)) {
            throw new LogicException('error.call.object_method');
        }

        if ($reflectionClass->getMethod($method)->isStatic()) {
            return call_user_func([$class, $method], ...$args);
        }

        if (is_string($class)) {
            $instance = self::getObjectInstance($class);
        }

        if (is_object($class)) {
            $instance = $class;
        }

        return call_user_func([$instance, $method], ...$args);
    }
}
