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

class Generic extends Controller implements DispatcherInterface
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
        $response->setHeader('Content-Security-Policy', "script-src 'self' https://cdnjs.cloudflare.com 'nonce-123456' 'unsafe-eval';");

        return new ModelAndView('/Views/Generic', json_encode(['content' => 'Hello World!']) ?: '');
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
