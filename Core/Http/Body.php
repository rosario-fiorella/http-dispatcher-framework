<?php

declare(strict_types=1);

namespace Core\Http;

use Core\Http\Interfaces\Http;

class Body implements Http
{
    /**
     * @since 1.0.0
     * @access protected
     * @var string $output
     */
    protected string $output = '';

    /**
     * @since 1.0.0
     * @param string $output
     * @return void
     */
    public function set(string $output): void
    {
        $this->output = $output;
    }

    /**
     * @since 1.0.0
     * @param string $output
     * @return void
     */
    public function add(string $output): void
    {
        $this->output .= $output;
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function send(): void
    {
        print $this->output;
    }
}
