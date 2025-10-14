<?php

declare(strict_types=1);

namespace App\Config;

use Core\Http\Request;
use Core\Utils\URIFilter;
use InvalidArgumentException;
use UnexpectedValueException;

class Router
{
    /**
     * @var array<string, string> $map
     */
    protected array $map = [];

    public function addHandler(string $regex, string $namespace): void
    {
        if (!class_exists($namespace)) {
            throw new InvalidArgumentException(_('error.class.notFound'));
        }

        $this->map[$regex] = $namespace;
    }

    public function getHandler(Request $request): string
    {
        $uri = new URIFilter($request->getPathWithoutQueryString());
        $uri->remove('/^\/index.php/');

        foreach ($this->map as $regex => $namespace) {
            if (preg_match($regex, $uri->getUri()) === 1) {
                return $namespace;
            }
        }

        throw new UnexpectedValueException(_('error.regex.matching'));
    }
}
