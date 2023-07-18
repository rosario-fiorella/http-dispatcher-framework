<?php

declare(strict_types=1);

namespace Core\Http;

use function \_;
use \UnexpectedValueException;

abstract class Controller
{
    /**
     * @since 1.0.0
     * @abstract
     * @access protected
     * @param Request $request
     * @param Response $response
     * @return ModelAndView
     */
    abstract protected function doDelete(Request $request, Response $response): ModelAndView;

    /**
     * @since 1.0.0
     * @abstract
     * @access protected
     * @param Request $request
     * @param Response $response
     * @return ModelAndView
     */
    abstract protected function doGet(Request $request, Response $response): ModelAndView;

    /**
     * @since 1.0.0
     * @abstract
     * @access protected
     * @param Request $request
     * @param Response $response
     * @return ModelAndView
     */
    abstract protected function doHead(Request $request, Response $response): ModelAndView;

    /**
     * @since 1.0.0
     * @abstract
     * @access protected
     * @param Request $request
     * @param Response $response
     * @return ModelAndView
     */
    abstract protected function doOptions(Request $request, Response $response): ModelAndView;

    /**
     * @since 1.0.0
     * @abstract
     * @access protected
     * @param Request $request
     * @param Response $response
     * @return ModelAndView
     */
    abstract protected function doPost(Request $request, Response $response): ModelAndView;

    /**
     * @since 1.0.0
     * @abstract
     * @access protected
     * @param Request $request
     * @param Response $response
     * @return ModelAndView
     */
    abstract protected function doPut(Request $request, Response $response): ModelAndView;

    /**
     * @since 1.0.0
     * @abstract
     * @access protected
     * @param Request $request
     * @param Response $response
     * @return ModelAndView
     */
    abstract protected function doTrace(Request $request, Response $response): ModelAndView;

    /**
     * @since 1.0.0
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods
     * @access protected
     * @param Request $request
     * @param Response $response
     * @return ModelAndView
     * @throws \UnexpectedValueException
     */
    public function doHandle(Request $request, Response $response): ModelAndView
    {
        if ($request->isGet()) {
            return $this->doGet($request, $response);
        } elseif ($request->isPost()) {
            return $this->doPost($request, $response);
        } elseif ($request->isDelete()) {
            return $this->doDelete($request, $response);
        } elseif ($request->isPut()) {
            return $this->doPut($request, $response);
        } elseif ($request->isHead()) {
            return $this->doHead($request, $response);
        } elseif ($request->isTrace()) {
            return $this->doTrace($request, $response);
        }

        throw new UnexpectedValueException(_('error.doHandle.UnexpectedValue'));
    }
}
