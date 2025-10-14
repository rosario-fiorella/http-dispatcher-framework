<?php

declare(strict_types=1);

namespace Core\Http;

use Core\Http\Interfaces\Http;
use ArrayObject;

class Header extends ArrayObject implements Http
{
    /**
     * @since 1.0.0
     * @return void
     */
    public function send(): void
    {
        foreach ($this->getIterator() as $k => $v) {
            if ($v && is_string($v)) {
                header(sprintf('%s: %s', $k, $v), true);
            }
        }
    }
}
