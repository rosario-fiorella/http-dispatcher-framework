<?php

declare(strict_types=1);

namespace Core\Utils;

trait SingletonTrait
{
    /**
     * @since 1.0.0
     * @access protected
     * @var null|self $instance
     */
    protected static ?self $instance = null;

    /**
     * @since 1.0.0
     * @return self
     */
    public static function run(): self
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @since 1.0.0
     * @access protected
     */
    protected function __construct()
    {
    }

    /**
     * @since 1.0.0
     * @access protected
     */
    protected function __clone()
    {
    }

    /**
     * @since 1.0.0
     */
    public function __sleep()
    {
    }

    /**
     * @since 1.0.0
     */
    public function __wakeup()
    {
    }
}
