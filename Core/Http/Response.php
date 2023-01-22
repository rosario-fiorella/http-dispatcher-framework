<?php

declare(strict_types=1);

namespace Core\Http;

use \Core\Utils\SingletonTrait;

class Response
{
    /**
     * @since 1.0.0
     * @var Status $status
     */
    protected Status $status;

    /**
     * @since 1.0.0
     * @var Header $header
     */
    protected Header $header;

    /**
     * @since 1.0.0
     * @var Body $body
     */
    protected Body $body;

    /**
     * @since 1.0.0
     */
    use SingletonTrait {
        __construct as super;
        run as cache;
    }

    /**
     * @since 1.0.0
     * @access protected
     */
    protected function __construct()
    {
        \Core\Logs\Logger::write(__CLASS__);

        $this->status = new Status;
        $this->header = new Header;
        $this->body = new Body;
    }

    /**
     * @since 1.0.0
     * @param string $key
     * @param string $value
     * @return self
     */
    public function setHeader(string $key, string $value): self
    {
        $this->header->set($key, $value);

        return $this;
    }

    /**
     * @since 1.0.0
     * @param integer $code
     * @return self
     */
    public function setStatus(int $code): self
    {
        $this->status->set($code);

        return $this;
    }

    /**
     * @since 1.0.0
     * @param string $body
     * @return self
     */
    public function setBody(string $body): self
    {
        $this->body->set($body);

        return $this;
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function send(): void
    {
        $this->header->add();
        $this->status->add();
        $this->body->add();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function ok(): void
    {
        $this->header->add();
        $this->status->set(Status::OK);
        $this->status->add();
        $this->body->add();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function badRequest(): void
    {
        $this->header->add();
        $this->status->set(Status::BAD_REQUEST);
        $this->status->add();
        $this->body->add();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function notAuthorized(): void
    {
        $this->header->add();
        $this->status->set(Status::UNAUTHORIZED);
        $this->status->add();
        $this->body->add();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function notAllowed(): void
    {
        $this->header->add();
        $this->status->set(Status::FORBIDDEN);
        $this->status->add();
        $this->body->add();
    }
}
