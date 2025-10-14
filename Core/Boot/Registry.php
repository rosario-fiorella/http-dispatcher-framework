<?php

declare(strict_types=1);

namespace Core\Boot;

use IteratorAggregate;
use Core\Utils\StaticRegistryTrait;

class Registry implements IteratorAggregate
{
    use StaticRegistryTrait;
}
