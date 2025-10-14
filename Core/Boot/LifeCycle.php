<?php

declare(strict_types=1);

namespace Core\Boot;

use Core\Context;
use Core\Http\Request;
use Core\Http\Response;

class LifeCycle
{
    /**
     * @since 1.0.0
     * @access protected
     * @var Loader $loader
     */
    protected Loader $loader;

    /**
     * @since 1.0.0
     * @access protected
     * @var Registry $registry
     */
    protected Registry $registry;

    /**
     * @since 1.0.0
     * @access protected
     * @var Context $context
     */
    protected Context $context;

    /**
     * @since 1.0.0
     * @access protected
     * @var Configurer $configurer
     */
    protected Configurer $configurer;

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function loader(): void
    {
        $this->configurer = new Configurer();
        $this->loader = new Loader();
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function registry(): void
    {
        $this->registry = new Registry();
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function instance(): void
    {
        $this->context = new Context($this->registry, $this->loader);
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function init(): void
    {
        $initializer = new Initializer($this->context, $this->configurer);
    }

    /**
     * @since 1.0.0
     * @access protected
     * @param Request $request
     * @param Response $response
     * @return void
     */
    protected function service(Request $request, Response $response): void
    {
        $this->context->initDispatch($request, $response);

        $this->context->preDispatch($request, $response);

        $this->context->doDispatch($request, $response);

        $this->context->postDispatch($request, $response);

        $this->context->shutdownDispatch($request, $response);
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function destroy(): void
    {
        $shutdown = new Shutdown($this->context, $this->configurer);
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function finalize(): void
    {
        $finalizer = new Finalizer($this->context, $this->configurer);
    }
}
