<?php

declare(strict_types=1);

namespace Core\Http;

use \Core\Interfaces\Application;
use \Core\Http\Interfaces\Dispatcher as DispatcherInterface;
use \Core\Http\Response;
use \Core\Http\Request;

class Dispatcher implements DispatcherInterface
{
    /**
     * @since 1.0.0
     * @access protected
     * @var Application $application
     */
    protected Application $application;

    /**
     * @since 1.0.0
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function init(): void
    {
        $this->application->init();
    }

    /**
     * @since 1.0.0
     * @access protected
     * @param Request $request
     * @param Response $response
     * @return void
     */
    protected function doDispatch(Request $request, Response $response)
    {
        $this->application->preHandle($request, $response);

        $this->application->doHandle($request, $response);

        $this->application->postHandle($request, $response);
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function service(Request $request, Response $response): void
    {
        $this->doDispatch($request, $response);
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function destroy(): void
    {
        $this->application->destroy();
    }
}
