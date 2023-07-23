<?php

declare(strict_types=1);

namespace Core\Logs;

class Logger
{
    /**
     * @param string $level
     * @param string $massage
     * @param array $data
     * @return void
     */
    public static function write(string $message = '', string $level = 'DEBUG', array $data = []): void
    {
        $prefix = 'Logs/';
        if (!is_dir($prefix)) {
            mkdir($prefix, 0777);
            chmod($prefix, 0777);
        }

        $filename = sprintf('%s%s.log', $prefix, date('Y-m-d'));
        $data = sprintf('%s %s %s', date('Y-m-d H:i:s'), $level, $message);

        file_put_contents($filename, $data . PHP_EOL, FILE_APPEND);
    }
}
