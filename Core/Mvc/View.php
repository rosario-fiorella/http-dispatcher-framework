<?php

declare(strict_types=1);

namespace Core\Mvc;

use \Core\Config\ViewResolver;
use \Core\Config\TemplateEngine;
use \Core\Http\Request;
use \Core\Http\Response;
use \RuntimeException;

class View
{
    /**
     * @since 1.0.0
     * @access protected
     * @var ViewResolver $view
     */
    protected ViewResolver $view;

    /**
     * @since 1.0.0
     * @access protected
     * @var TemplateEngine $template
     */
    protected TemplateEngine $template;

    /**
     * @since 1.0.0
     * @param ModelAndView $modelAndView
     * @param Request $request
     * @param Response $response
     * @throws RuntimeException
     */
    public function __construct(ModelAndView $modelAndView, Request $request, Response $response)
    {
        \Core\Logs\Logger::write(__CLASS__);

        $this->view = new ViewResolver($modelAndView->getViewName());
        $this->template = new TemplateEngine($modelAndView->getModel());

        $output = $this->render();

        $response->setBody($output);
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function render(): string
    {
        ob_start();

        $data = $this->template->jsonSerialize();
        $this->view->setVars($data);

        return ob_get_clean() ?: '';
    }
}
