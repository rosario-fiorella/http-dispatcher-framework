<?php

declare(strict_types=1);

namespace Core\Http;

use \Core\Http\Interfaces\Interceptor as InterceptorInterface;
use \Core\Http\Negotiation;
use \core\Utils\ObjectFactory;
use \SplObjectStorage;

class Interceptor
{
    /**
     * @since 1.0.0
     * @access protected
     * @var SplObjectStorage $interceptor
     */
    protected SplObjectStorage $interceptor;

    /**
     * @since 1.0.0
     * @access protected
     * @var Negotiation $negotiation
     */
    protected Negotiation $negotiation;

    /**
     * @since 1.0.0
     * @param Negotiation $negotiation
     */
    public function __construct(Negotiation $negotiation)
    {
        $this->interceptor = new SplObjectStorage;

        $this->negotiation = $negotiation;
    }

    /**
     * @since 1.0.0
     * @param InterceptorInterface $object
     * @param mixed $info
     * @return void
     */
    public function add(InterceptorInterface $object, mixed $info = null): void
    {
        $this->interceptor->attach($object, $info);
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @param string $handler
     * @return void
     */
    public function preHandle(Request $request, Response $response, string $handler): void
    {
        foreach ($this->interceptor as $interceptorInstance) {
            ObjectFactory::callObjectMethod($interceptorInstance, __FUNCTION__, [$request, $response, $handler, $this->negotiation]);
        }
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @param Controller $handler
     * @param ModelAndView $modelAndView
     * @return void
     */
    public function postHandle(Request $request, Response $response, Controller $handler, ModelAndView $modelAndView): void
    {
        foreach ($this->interceptor as $interceptorInstance) {
            ObjectFactory::callObjectMethod($interceptorInstance, __FUNCTION__, [$request, $response, $handler, $modelAndView, $this->negotiation]);
        }
    }
}
