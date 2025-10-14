<?php

declare(strict_types=1);

namespace App;

use App\Boot\Initializer;
use Core\Task;

class Http extends Task
{
    protected function init(): void
    {
        $initializer = new Initializer($this->context, $this->configurer);
    }
}
