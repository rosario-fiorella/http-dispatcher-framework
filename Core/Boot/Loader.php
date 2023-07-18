<?php

declare(strict_types=1);

namespace Core\Boot;

use \ErrorException;

class Loader
{
    public function __construct()
    {
        $this->setErrorHandler();

        $this->shutdownFunction();
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function setErrorHandler(): void
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

                throw new ErrorException($error, error_reporting(), $level, $file, $line);
            },
            E_ALL
        );
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function shutdownFunction(): void
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
