<?php

declare(strict_types=1);

namespace Core\Http;

use Core\Utils\EnumTrait;

enum Method: string
{
    use EnumTrait;

    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
    case OPTIONS = 'OPTIONS';
    case HEAD = 'HEAD';
    case TRACE = 'TRACE';
}
