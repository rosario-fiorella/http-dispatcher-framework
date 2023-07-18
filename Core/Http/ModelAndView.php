<?php

declare(strict_types=1);

namespace Core\Http;

use \JsonException;

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
     * @param string $viewName
     * @param string $json
     */
    public function __construct(string $viewName = '', string $json = '')
    {
        if ($viewName) {
            $this->setViewName($viewName);
        }

        if (!$json) {
            return;
        }

        $obj = json_decode($json) ?: null;

        if (json_last_error()) {
            throw new JsonException(json_last_error_msg(), json_last_error());
        }

        $this->setModel($obj);
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
    public function hasView(): bool
    {
        return !empty($this->viewName);
    }

    /**
     * @since 1.0.0
     * @param object $data
     * @return void
     */
    public function setModel(object $data): void
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

    /**
     * @since 1.0.0
     * @return boolean
     */
    public function hasModel(): bool
    {
        return is_object($this->modelData);
    }
}
