<?php

declare(strict_types=1);

namespace Core\Utils;

use \Core\Http\Method;
use \Core\http\Request;
use stdClass;

class SwaggerOpenApi
{
    /**
     * @since 1.0.0
     * @var object $data
     */
    protected object $data;

    /**
     * @since 1.0.0
     * @param stdClass $data
     */
    public function __construct(stdClass $data)
    {
        \Core\Logs\Logger::write(__CLASS__);

        $this->data = $data;
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function parse(): string
    {
        $controllerName = '';
        $requestMethod = $this->mappingMethod();
        $request = Request::run();

        foreach ($this->data->paths as $pattern => $httpMethod) {
            if (!property_exists($httpMethod, $requestMethod)) {
                continue;
            }

            $regex = $pattern;
            if (property_exists($httpMethod->{$requestMethod}, 'parameters')) {
                foreach ($httpMethod->{$requestMethod}->parameters as $paramObj) {
                    if ($paramObj->in === 'path') {
                        $exp = $paramObj->schema->type === 'integer' ? '([\d]+)' : '([\w\d]+)';
                        $regex = str_replace('{' . $paramObj->name . '}', $exp, $regex);
                    }
                }
            }

            $regex = sprintf('/%s/', str_replace('/', '\/', $regex));
            $requestPath = $request->getPathWithoutQueryString();

            if (preg_match($regex, $requestPath) === 1) {
                $controllerName = $httpMethod->{$requestMethod}->tags[0];
                break;
            }
        }

        return $controllerName;
    }

    /**
     * @since 1.0.0
     * @return null|string
     */
    public function mappingMethod(): ?string
    {
        $requestMethod = Request::run()->getMethod();

        $methods = [
            Method::GET => 'get',
            Method::POST => 'post',
            Method::PUT => 'put',
            Method::DELETE => 'delete',
            Method::OPTIONS => 'options',
            Method::HEAD => 'head'
        ];

        return array_key_exists($requestMethod, $methods) ? $methods[$requestMethod] : null;
    }
}
