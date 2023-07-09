<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
putenv('LC_ALL=it_IT');
setlocale(LC_ALL, 'it_IT');

chdir(dirname(__DIR__));

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

        $classPath = sprintf('%s/%s.php', dirname(__DIR__), $className);

        if (!file_exists($classPath)) {
            throw new InvalidArgumentException('error.class.notFound');
        }

        include_once $classPath;
    }
);
