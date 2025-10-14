<?php

declare(strict_types=1);

namespace Core\Boot;

use Core\Context;

class Shutdown
{
    /**
     * @since 1.0.0
     * @param Context $context
     * @param Configurer $configurer
     */
    public function __construct(Context $context, Configurer $configurer)
    {
        $configurer->configureOnShutdown($context);
    }
}
