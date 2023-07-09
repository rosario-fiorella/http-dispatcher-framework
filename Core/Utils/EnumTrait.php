<?php

declare(strict_types=1);

namespace Core\Utils;

trait EnumTrait
{
    /**
     * @since 1.0.0
     * @static
     * @return string[]
     */
    public static function getNames(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @since 1.0.0
     * @static
     * @return string[]|int[]
     */
    public static function gatValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
