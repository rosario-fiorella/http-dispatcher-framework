<?php

declare(strict_types=1);

namespace Core\Config;

use \ErrorException;

class ErrorManager
{
    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        \Core\Logs\Logger::write(__CLASS__);

        $debug = Config::get('debug', '0');
        $debug = is_numeric($debug) ? $debug : '0';

        if ($debug === '1') {
            error_reporting(E_ALL);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        }

        ini_set('display_errors', $debug);
        ini_set('display_startup_errors', $debug);
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public static function handler()
    {
        set_error_handler(
            /**
             * @since 1.0.0
             * @param int $level
             * @param string $error
             * @param string $file
             * @param int $line
             * @throws ErrorException
             */
            function (int $level, string $error, string $file, int $line): void {
                if (0 === error_reporting()) {
                    return;
                }

                throw new ErrorException($error, -1, $level, $file, $line);
            },
            E_ALL
        );
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public static function shutdownFunction()
    {
        register_shutdown_function(
            /**
             * @since 1.0.0
             * @return void
             * @throws ErrorException
             */
            function (): void {
                if (!($error = error_get_last())) {
                    return;
                }

                throw new ErrorException(
                    $error['message'],
                    -1,
                    $error['type'],
                    $error['file'],
                    $error['line']
                );
            }
        );
    }
}
