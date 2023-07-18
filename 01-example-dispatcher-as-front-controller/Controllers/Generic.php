<?php

declare(strict_types=1);

namespace App\Controllers;

use \Core\Http\Controller;
use \Core\Http\Interfaces\Dispatcher as DispatcherInterface;
use \Core\Http\ModelAndView;
use \Core\Http\Response;
use \Core\Http\Request;
use \Core\Http\View;
use \RuntimeException;

class Generic extends Controller implements DispatcherInterface
{
    protected ModelAndView $modelAndView;
    protected View $view;

    #[Override]
    public function init(): void
    {
    }

    #[Override]
    protected function doDelete(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    #[Override]
    protected function doGet(Request $request, Response $response): ModelAndView
    {
        return new ModelAndView('/Views/Generic', json_encode(['content' => 'Hello World!']));
    }

    #[Override]
    protected function doHead(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    #[Override]
    protected function doOptions(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    #[Override]
    protected function doPost(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    #[Override]
    protected function doPut(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    #[Override]
    protected function doTrace(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    #[Override]
    public function service(Request $request, Response $response): void
    {
        $this->modelAndView = $this->doHandle($request, $response);

        $this->view = new View($this->modelAndView, $request, $response);

        $output = $this->render();

        $response->setBody($output);
    }

    public function render(): string
    {
        return $this->view->render();
    }

    #[Override]
    public function destroy(): void
    {
    }
}
