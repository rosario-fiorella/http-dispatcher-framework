<?php

declare(strict_types=1);

namespace Core\Http;

use function _;

use Core\Utils\ObjectSerializable;
use InvalidArgumentException;
use RuntimeException;

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
     */
    public function __construct(ModelAndView $modelAndView)
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
     * @throws RuntimeException
     */
    protected function setPath(string $filename): void
    {
        if (empty($filename)) {
            throw new InvalidArgumentException(_('error.path.notFound'));
        }

        $baseDir = getcwd() . DIRECTORY_SEPARATOR;
        $realPath = realpath($baseDir . $filename . '.php');

        if ($realPath === false || strncmp($realPath, $baseDir, strlen($baseDir)) !== 0) {
            throw new RuntimeException(_('error.path.notFound'));
        }

        $this->filename = $realPath;
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
     * @param string $template
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

        $output = '';

        if ($this->template) {
            $output = $this->template->jsonSerialize();
        }

        $this->setVars($output);

        return ob_get_clean() ?: '';
    }
}
