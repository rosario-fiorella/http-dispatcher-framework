<?php

namespace App\Proxy;

use \App\Config\Router;
use \App\Modules\Test\Controllers\Index as TestController;
use \Core\Context;
use \Core\Http\ModelAndView;
use \Core\Http\Request;
use \Core\Http\Response;
use \Core\Http\View;
use \Core\Interfaces\Application as ApplicationInterface;
use \Core\Utils\ObjectFactory;

class Application implements ApplicationInterface
{
    protected Context $context;
    protected Router $router;
    protected ?string $controllerName = null;
    protected ?object $controllerInstance = null;
    protected ?ModelAndView $modelAndView = null;
    protected ?View $view = null;

    public function __construct(Context $context)
    {
        $this->context = $context;

        $this->router = new Router;
    }

    public function init(): void
    {
        $this->router->addHandler('/(.+)/', TestController::class);
    }

    public function preHandle(Request $request, Response $response): void
    {
        $this->controllerName = $this->router->getHandler($request);

        $this->context->getInterceptor()->preHandle($request, $response, $this->controllerName);
    }

    public function doHandle(Request $request, Response $response): void
    {
        $this->controllerInstance = ObjectFactory::getObjectInstance($this->controllerName);

        $this->modelAndView = ObjectFactory::callObjectMethod($this->controllerInstance, __FUNCTION__, [$request, $response]);
    }

    public function postHandle(Request $request, Response $response): void
    {
        $this->context->getInterceptor()->postHandle($request, $response, $this->controllerInstance, $this->modelAndView);

        $this->view = new View($this->modelAndView, $request, $response);

        $output = $this->render();

        $response->setBody($output);
    }

    public function render(): string
    {
        return $this->view->render();
    }

    public function destroy(): void
    {
    }
}
