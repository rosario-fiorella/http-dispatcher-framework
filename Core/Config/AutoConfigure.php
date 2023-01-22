<?php

declare(strict_types=1);

namespace Core\Config;

use \Core\Utils\SingletonTrait;
use \Core\Config\Config;
use \Core\Config\Env;
use \Core\Config\ErrorManager;
use \ErrorException;

class AutoConfigure
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
     */
    protected function __construct()
    {
        \Core\Logs\Logger::write(__CLASS__);

        $this->registerErrorHandler();
        $this->registerShutdownFunction();
        $this->registerEnvironment();
        $this->registerConfiguration();
        $this->registerErrorStrict();
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function registerErrorStrict(): void
    {
        $error = new ErrorManager;
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function registerEnvironment(): void
    {
        $env = Env::cache();
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function registerConfiguration(): void
    {
        $config = Config::cache();
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     * @throws ErrorException
     */
    protected function registerErrorHandler(): void
    {
        ErrorManager::handler();
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     * @throws ErrorException
     */
    protected function registerShutdownFunction(): void
    {
        ErrorManager::shutdownFunction();
    }
}
