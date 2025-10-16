<?php

declare(strict_types=1);

namespace Core\Http;

use function _;

use Core\Http\Interfaces\Dispatcher;
use Core\Utils\URIFilter;
use RuntimeException;

class Router
{
    /**
     * @since 1.0.0
     * @access protected
     * @var array<string, Dispatcher> $map
     */
    protected array $map = [];

    /**
     * @param string $path
     * @param Dispatcher $dispatcher
     * @return void
     */
    public function addDispatcher(string $path, Dispatcher $dispatcher): void
    {
        $this->map[$path] = $dispatcher;
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @return Dispatcher
     * @throws RuntimeException
     */
    public function getDispatcher(Request $request): Dispatcher
    {
        $uri = new URIFilter($request->getPathWithoutQueryString());
        $uri->remove('/^\/index.php/');

        foreach ($this->map as $regex => $dispatcher) {
            if (preg_match($regex, $uri->getUri()) === 1) {
                return $dispatcher;
            }
        }

        throw new RuntimeException(_('error.regex.matching'));
    }
}
