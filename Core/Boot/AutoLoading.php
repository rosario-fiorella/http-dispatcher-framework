<?php

declare(strict_types=1);

namespace Core\Boot;

use \Core\Utils\SingletonTrait;
use \InvalidArgumentException;

if (!trait_exists('SingletonTrait')) {
    include_once dirname(__DIR__) . '/Utils/SingletonTrait.php';
}

class AutoLoading
{
    /**
     * @since 1.0.0
     */
    use SingletonTrait {
        __construct as super;
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function __construct()
    {
        spl_autoload_register(
            /**
             * @since 1.0.0
             * @param string $className
             * @return void
             * @throws InvalidArgumentException
             */
            function (string $className): void {
                if (class_exists($className)) {
                    return;
                }

                if (preg_match('/^[a-zA-Z\d\\\\?]+$/', $className) !== 1) {
                    throw new InvalidArgumentException('error.regex.notMatched');
                }

                $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
                $classPath = sprintf('%s/%s.php', dirname(dirname(__DIR__)), $className);

                if (!file_exists($classPath)) {
                    throw new InvalidArgumentException('error.class.notFound');
                }

                include_once $classPath;
            }
        );

        \Core\Logs\Logger::write(__CLASS__);
    }
}
