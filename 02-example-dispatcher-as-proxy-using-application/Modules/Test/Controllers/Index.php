<?php

declare(strict_types=1);

namespace App\Modules\Test\Controllers;

use function _;

use Core\Http\Controller;
use Core\Http\ModelAndView;
use Core\Http\Request;
use Core\Http\Response;
use RuntimeException;

class Index extends Controller
{
    protected function doDelete(Request $request, Response $response): ModelAndView
    {
        throw new RuntimeException(_('error.method.not_implemented'));
    }

    protected function doGet(Request $request, Response $response): ModelAndView
    {
        return new ModelAndView('/Modules/Test/Views/Home', json_encode(['content' => 'Hello World!']));
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
}
