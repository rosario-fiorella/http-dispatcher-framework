<?php

declare(strict_types=1);

namespace Core\Utils;

use \Core\Boot\Configurer;
use \Core\Boot\Loader;
use \Core\Boot\Registry;
use \Core\Interfaces\Application;
use LogicException;
use \UnexpectedValueException;

class ObjectStorage
{
    /**
     * @since 1.0.0
     * @access protected
     * @var array<string, object> $cache
     */
    protected static $cache = [];

    /**
     * @since 1.0.0
     * @access protected
     * @var Configurer $configurer
     */
    protected Configurer $configurer;

    /**
     * @since 1.0.0
     * @access protected
     * @var Loader $loader
     */
    protected Loader $loader;

    /**
     * @since 1.0.0
     * @access protected
     * @var Registry $registry
     */
    protected Registry $registry;

    /**
     * @since 1.0.0
     * @param Registry $registry
     * @param Loader $loader
     * @param Configurer $configurer
     */
    public function __construct(Registry $registry, Loader $loader, Configurer $configurer)
    {
        $this->registry = $registry;
        $this->loader = $loader;
        $this->configurer = $configurer;
    }

    /**
     * @since 1.0.0
     * @final
     * @param string $namespace
     * @param mixed ...$args
     * @return object
     */
    final public static function getObjectInstance(string $namespace, mixed ...$args): object
    {
        if (array_key_exists($namespace, static::$cache)) {
            return (static::$cache)[$namespace];
        }

        $instance = ObjectFactory::getObjectInstance($namespace, $args);

        (static::$cache)[$namespace] = $instance;

        return $instance;
    }

    /**
     * @since 1.0.0
     * @param mixed ...$arg
     * @return Application
     * @throws UnexpectedValueException
     * @throws LogicException
     */
    public function instanceApplication(...$arg): Application
    {
        $namespace = $this->registry->get('application');

        if (!$namespace) {
            throw new UnexpectedValueException('error.value');
        }

        if (!class_exists($namespace)) {
            throw new LogicException('error.value');
        }

        $application = $this->getObjectInstance($namespace, ...$arg);

        return $this->configurer->configureApplication($application);
    }
}
