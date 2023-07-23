<?php

declare(strict_types=1);

namespace Core\Config;

class ViewResolver
{
    /**
     * @since 1.0.0
     * @var string $filename
     */
    protected string $filename = '';

    /**
     * @since 1.0.0
     * @param string $viewName
     * @return null|object
     * @throws ViewResolverException
     */
    public function __construct(string $viewName)
    {
        \Core\Logs\Logger::write(__CLASS__);

        if (!$viewName) {
            return;
        }

        $path = sprintf('%s.php', $viewName);
        if (file_exists($path)) {
            $this->filename = $path;
            return;
        }

        throw new ViewResolverException('error.file.notFound');
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
     * @param string $data
     * @return void
     */
    public function setVars(string $data): void
    {
        $data = $data;

        if ($this->getPath()) {
            include_once $this->getPath();
        }
    }
}
