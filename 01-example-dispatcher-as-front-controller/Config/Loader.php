<?php

declare(strict_types=1);

namespace App\Config;

use InvalidArgumentException;
use LogicException;

class Loader
{
    public function __construct()
    {
        spl_autoload_register(
            /**
             * @since 1.0.0
             * @param string $className
             * @return void
             * @throws InvalidArgumentException
             * @throws LogicException
             */
            function (string $className): void {
                if (class_exists($className)) {
                    return;
                }

                if (preg_match('/^[a-zA-Z\d\\\\?]+$/', $className) !== 1) {
                    throw new InvalidArgumentException(_('error.regex.matching'));
                }

                $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
                $className = str_replace('App/', pathinfo(dirname(__DIR__), PATHINFO_BASENAME) . '/', $className);

                $classPath = sprintf('%s/%s.php', dirname(getcwd() ?: ''), $className);

                if (!file_exists($classPath)) {
                    throw new LogicException(_('error.file.notFound'));
                }

                include_once $classPath;
            }
        );
    }
}
