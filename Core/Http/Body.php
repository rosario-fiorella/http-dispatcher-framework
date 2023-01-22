<?php

declare(strict_types=1);

namespace Core\Http;

class Body
{
    /**
     * @since 1.0.0
     * @access protected
     * @var string $data
     */
    protected string $data = '';

    /**
     * @since 1.0.0
     * @param string $data
     * @return void
     */
    public function set(string $data): void
    {
        $this->data = $data;
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function add(): void
    {
        echo $this->data;
    }
}
