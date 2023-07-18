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
     * @param Registry $registry
     * @param Loader $loader
     * @param Configurer $configurer
     */
    public function __construct(
        protected Registry $registry,
        protected Loader $loader,
        protected Configurer $configurer
    ) {
    }

    /**
     * @since 1.0.0
     * @final
     * @param string $namespace
     * @param array $args
     * @return object
     */
    final public static function getObjectInstance(string $namespace, array $args = []): object
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
     * @param array $args
     * @return Application
     * @throws UnexpectedValueException
     * @throws LogicException
     */
    public function instanceApplication(array $args = []): Application
    {
        $namespace = $this->registry->get('application');

        $application = $this->getObjectInstance($namespace, $args);

        return $this->configurer->configureApplication($application);
    }
}
