<?php

declare(strict_types=1);

namespace App;

use \App\Boot\Configurer as HttpConfigurer;
use \App\Proxy\Application as ProxyApplication;
use \Core\Task;

class Http extends Task
{
    protected function registry(): void
    {
        parent::registry();

        $this->registry->set('application', ProxyApplication::class);
    }

    protected function instance(): void
    {
        parent::instance();

        $this->configurer = new HttpConfigurer;
    }
}
