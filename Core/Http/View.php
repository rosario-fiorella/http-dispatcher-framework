<?php

declare(strict_types=1);

namespace Core\Http;

use function \_;
use \Core\Utils\ObjectSerializable;
use \InvalidArgumentException;

class View
{
    /**
     * @since 1.0.0
     * @access protected
     * @var string $filename
     */
    protected string $filename = '';

    /**
     * @since 1.0.0
     * @access protected
     * @var ObjectSerializable|null
     */
    protected ?ObjectSerializable $template = null;

    /**
     * @since 1.0.0
     * @param ModelAndView $modelAndView
     * @param Request $request
     * @param Response $response
     */
    public function __construct(ModelAndView $modelAndView, Request $request, Response $response)
    {
        if ($modelAndView->hasView()) {
            $this->setPath($modelAndView->getViewName());
        }

        if ($modelAndView->hasModel()) {
            $this->setTemplate($modelAndView->getModel());
        }
    }

    /**
     * @since 1.0.0
     * @access protected
     * @param object|null $object
     * @return void
     */
    protected function setTemplate(?object $object = null): void
    {
        $this->template = new ObjectSerializable($object);
    }

    /**
     * @since 1.0.0
     * @return ObjectSerializable|null
     */
    public function getTemplate(): ?ObjectSerializable
    {
        return $this->template;
    }

    /**
     * @since 1.0.0
     * @access protected
     * @param string $filename
     * @return void
     * @throws InvalidArgumentException
     */
    protected function setPath(string $filename): void
    {
        if (!$filename) {
            return;
        }

        $path = sprintf('%s%s.php', getcwd(), $filename);

        if (file_exists($path)) {
            $this->filename = $path;
            return;
        }

        throw new InvalidArgumentException(_('error.path.notFound'));
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function getPath(): string
    {
        return $this->filename;
    }

    /**
     * @since 1.0.0
     * @access protected
     * @param string $data
     * @return void
     */
    protected function setVars(string $template = ''): void
    {
        $data = $template;

        if ($this->getPath()) {
            include_once $this->getPath();
        }
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function render(): string
    {
        ob_start();

        $output = $this->template->jsonSerialize();

        $this->setVars($output);

        return ob_get_clean() ?: '';
    }
}
