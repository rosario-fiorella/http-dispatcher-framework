<?php

declare(strict_types=1);

namespace Core\Http\Interfaces;

interface Http
{
    public function send(): void;
}
