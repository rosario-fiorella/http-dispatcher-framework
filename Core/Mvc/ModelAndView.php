<?php

declare(strict_types=1);

namespace Core\Mvc;

class ModelAndView
{
    /**
     * @since 1.0.0
     * @access protected
     * @var string $viewName
     */
    protected string $viewName = '';

    /**
     * @since 1.0.0
     * @var null|object $modelData
     */
    protected ?object $modelData = null;

    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        \Core\Logs\Logger::write(__CLASS__);
    }

    /**
     * @since 1.0.0
     * @return boolean
     */
    public function hasView(): bool
    {
        return !empty($this->viewName);
    }

    /**
     * @since 1.0.0
     * @param string $viewName
     * @return void
     */
    public function setViewName(string $viewName): void
    {
        $this->viewName = $viewName;
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function getViewName(): string
    {
        return $this->viewName;
    }

    /**
     * @since 1.0.0
     * @return boolean
     */
    public function hasModel(): bool
    {
        return is_object($this->modelData);
    }

    /**
     * @since 1.0.0
     * @param object $data
     * @return void
     */
    public function addModel(object $data): void
    {
        $this->modelData = $data;
    }

    /**
     * @since 1.0.0
     * @return null|object
     */
    public function getModel(): ?object
    {
        return $this->modelData;
    }
}
