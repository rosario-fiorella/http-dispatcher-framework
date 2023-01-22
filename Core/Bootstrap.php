<?php

declare(strict_types=1);

namespace Core;

/**
 * @since 1.0.0
 * @return \Core\Boot\Application
 * @throws Throwable
 */
function bootstrap(): \Core\Boot\Application
{
    if (!class_exists(\Core\Boot\Application::class)) {
        include_once __DIR__ . '/Boot/Application.php';
    }

    return new \Core\Boot\Application;
}
