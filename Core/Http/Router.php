<?php

declare(strict_types=1);

namespace Core\Http;

use \Core\Utils\SwaggerOpenApi;
use \Core\Http\RouterException;

class Router
{
    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        \Core\Logs\Logger::write(__CLASS__);
    }

    /**
     * @since 1.0.0
     * @return string
     * @throws RouterException
     */
    public function handle(): string
    {
        $routing = 'routing.json';
        if (!file_exists($routing)) {
            throw new RouterException('error.routing.not_found');
        }

        $data = file_get_contents($routing);
        $json = json_decode($data);

        $swagger = new SwaggerOpenApi($json);
        $controllerName = $swagger->parse();

        return $this->resolveControllerName($controllerName);
    }

    /**
     * @since 1.0.0
     * @access protected
     * @param string $ns
     * @return string
     * @throws RouterException
     */
    protected function resolveControllerName(string $ns): string
    {
        $appPath = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME);
        $appFolder = ltrim(substr($appPath, strrpos($appPath, '/')) ?: '', '/');
        $moduleName = strstr($ns, '/', true);
        $controllerName = ltrim(strstr($ns, '/') ?: '', '/');

        if (!$moduleName) {
            throw new RouterException('error.routing.module.not_found');
        }

        if (!$controllerName) {
            throw new RouterException('error.routing.controller.not_found');
        }

        $namespace = sprintf(
            '/%s/Modules/%s/Controllers/%sController',
            $appFolder,
            $moduleName,
            $controllerName
        );

        $namespace = str_replace('/', '\\', $namespace);
        if (!class_exists($namespace)) {
            throw new RouterException('error.routing.namespace.not_found');
        }

        return $namespace;
    }
}
