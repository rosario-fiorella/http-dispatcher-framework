<?php

declare(strict_types=1);

namespace Core\Utils;

class ObjectSupport
{
    /**
     * @since 1.0.0
     * @return string
     */
    public function getTempDir(): string
    {
        return sys_get_temp_dir();
    }
}
