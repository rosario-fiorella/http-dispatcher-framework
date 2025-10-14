<?php

declare(strict_types=1);

namespace Core\Http;

class Response
{
    /**
     * @since 1.0.0
     * @access protected
     * @var Status $status
     */
    protected Status $status;

    /**
     * @since 1.0.0
     * @access protected
     * @var Header $header
     */
    protected Header $header;

    /**
     * @since 1.0.0
     * @access protected
     * @var Body $body
     */
    protected Body $body;

    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->status = Status::from(200);
        $this->header = new Header();
        $this->body = new Body();
    }

    /**
     * @since 1.0.0
     * @param string $key
     * @param string $value
     * @return void
     */
    public function setHeader(string $key, string $value): void
    {
        $this->header->offsetSet($key, $value);
    }

    /**
     * @since 1.0.0
     * @param integer $code
     * @return void
     */
    public function setStatus(int $code): void
    {
        $this->status = Status::from($code);
    }

    /**
     * @since 1.0.0
     * @param string $body
     * @return void
     */
    public function setBody(string $body): void
    {
        $this->body->set($body);
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function send(): void
    {
        $this->header->send();
        Status::send($this->status->value);
        $this->body->send();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function ok(): void
    {
        $this->header->send();
        Status::send(200);
        $this->body->send();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function badRequest(): void
    {
        $this->header->send();
        Status::send(400);
        $this->body->send();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function notAuthorized(): void
    {
        $this->header->send();
        Status::send(401);
        $this->body->send();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function notAllowed(): void
    {
        $this->header->send();
        Status::send(403);
        $this->body->send();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function notFound(): void
    {
        $this->header->send();
        Status::send(404);
        $this->body->send();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function internalServerError(): void
    {
        $this->header->send();
        Status::send(500);
        $this->body->send();
    }
}
