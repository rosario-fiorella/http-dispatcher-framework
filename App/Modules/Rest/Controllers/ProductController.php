<?php

namespace App\Modules\Rest\Controllers;

use \Core\Mvc\AbstractController;
use \Core\Mvc\ModelAndView;
use \Core\http\Request;
use \Core\http\Response;
use \stdClass;

class ProductController extends AbstractController
{
    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return ModelAndView
     */
    public function handleRequest(Request $request, Response $response): ModelAndView
    {
        \Core\Logs\Logger::write(__CLASS__);

        $dto = new stdClass;
        $dto->data = [];

        for ($i = 0; $i < 5; ++$i) {
            $dto->data[] = [
                'title' => 'Product title n. ' . $i,
                'content' => 'Product content.'
            ];
        }

        $modelAndView = new ModelAndView;
        $modelAndView->setViewName('Modules/Rest/Views/index');
        $modelAndView->addModel($dto);

        $response->setStatus(200);
        $response->setHeader('content-type', 'application/json');

        return $modelAndView;
    }
}
