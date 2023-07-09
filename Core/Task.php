<?php

declare(strict_types=1);

namespace Core;

use \Core\Boot\LifeCycle;
use \Core\Http\Request;
use \Core\Http\Response;

class Task extends LifeCycle
{
    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->loader();
        $this->registry();
        $this->instance();
        $this->init();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function startup(): void
    {
        $this->service(new Request, new Response);
    }

    /**
     * @since 1.0.0
     */
    public function __destruct()
    {
        $this->destroy();
        $this->finalize();
    }
}
