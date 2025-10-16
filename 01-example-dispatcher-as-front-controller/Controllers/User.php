<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Http\Controller;
use Core\Http\Interfaces\Dispatcher as DispatcherInterface;
use Core\Http\ModelAndView;
use Core\Http\Response;
use Core\Http\Request;
use Core\Http\View;
use RuntimeException;

class User extends Controller implements DispatcherInterface
{
    protected ModelAndView $modelAndView;
    protected View $view;

    public function init(): void
    {
    }

    protected function doDelete(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    protected function doGet(Request $request, Response $response): ModelAndView
    {
        $user = [
            'id' => rand(1, 1000),
            'name' => 'Mario',
            'lastname' => 'Rossi',
            'email' => 'email@example.net'
        ];

        $response->setHeader('content-type', 'application/json');
        $response->setBody(json_encode($user));
        $response->ok();
        exit;
    }

    protected function doHead(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    protected function doOptions(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    protected function doPost(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    protected function doPut(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    protected function doTrace(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    public function service(Request $request, Response $response): void
    {
        $this->modelAndView = $this->doHandle($request, $response);

        $this->view = new View($this->modelAndView);

        $response->setBody($this->view->render());
    }

    public function destroy(): void
    {
    }
}
