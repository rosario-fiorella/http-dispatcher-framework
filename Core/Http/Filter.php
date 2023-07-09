<?php

declare(strict_types=1);

namespace Core\Http;

use \Core\Http\Interfaces\Filter as FilterInterface;
use \Core\Http\Negotiation;
use \core\Utils\ObjectFactory;
use \SplObjectStorage;

class Filter
{
    /**
     * @since 1.0.0
     * @access protected
     * @var SplObjectStorage $filter
     */
    protected SplObjectStorage $filter;

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
        $this->filter = new SplObjectStorage;

        $this->negotiation = $negotiation;
    }

    /**
     * @since 1.0.0
     * @param FilterInterface $object
     * @param mixed $info
     * @return void
     */
    public function add(FilterInterface $object, mixed $info = null): void
    {
        $this->filter->attach($object, $info);
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function init(Request $request, Response $response): void
    {
        foreach ($this->filter as $filterInstance) {
            ObjectFactory::callObjectMethod($filterInstance, __FUNCTION__, $request, $response, $this->negotiation);
        }
    }

    /**
     * @since 1.0.0
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function destroy(Request $request, Response $response): void
    {
        foreach ($this->filter as $filterInstance) {
            ObjectFactory::callObjectMethod($filterInstance, __FUNCTION__, $request, $response, $this->negotiation);
        }
    }
}
