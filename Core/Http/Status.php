<?php

declare(strict_types=1);

namespace Core\Http;

use \InvalidArgumentException;

class Status
{
    const HTTP_CONTINUE = 100;
    const SWITCHING_PROTOCOLS = 101;
    const PROCESSING = 102;
    const OK = 200;
    const CREATED = 201;
    const ACCEPTED = 202;
    const NON_AUTHORITATIVE_INFORMATION = 203;
    const NO_CONTENT = 204;
    const RESET_CONTENT = 205;
    const PARTIAL_CONTENT = 206;
    const MULTI_STATUS = 207;
    const ALREADY_REPORTED = 208;
    const MULTIPLE_CHOICES = 300;
    const MOVED_PERMANENTLY = 301;
    const FOUND = 302;
    const SEE_OTHER = 303;
    const NOT_MODIFIED = 304;
    const USE_PROXY = 305;
    const RESERVED = 306;
    const TEMPORARY_REDIRECT = 307;
    const PERMANENT_REDIRECT = 308;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const PAYMENT_REQUIRED = 402;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    const NOT_ACCEPTABLE = 406;
    const PROXY_AUTHENTICATION_REQUIRED = 407;
    const REQUEST_TIMEOUT = 408;
    const CONFLICT = 409;
    const GONE = 410;
    const LENGTH_REQUIRED = 411;
    const PRECONDITION_FAILED = 412;
    const REQUEST_ENTITY_TOO_LARGE = 413;
    const REQUEST_URI_TOO_LONG = 414;
    const UNSUPPORTED_MEDIA_TYPE = 415;
    const REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const EXPECTATION_FAILED = 417;
    const IM_A_TEAPOT = 418;
    const ENHANCE_YOUR_CALM = 420;
    const UNPROCESSABLE_ENTITY = 422;
    const UPGRADE_REQUIRED = 426;
    const TOO_MANY_REQUESTS = 429;
    const REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    const RETRY_WITH = 449;
    const UNAVAILABLE_FOR_LEGAL_REASONS = 451;
    const INTERNAL_SERVER_ERROR = 500;
    const NOT_IMPLEMENTED = 501;
    const BAD_GATEWAY = 502;
    const SERVICE_UNAVAILABLE = 503;
    const GATEWAY_TIMEOUT = 504;
    const HTTP_VERSION_NOT_SUPPORTED = 505;
    const BANWIDTH_LIMIT_EXCEEDED = 509;

    /**
     * @since 1.0.0
     * @var integer $code
     */
    protected int $code = 200;

    /**
     * @since 1.0.0
     * @param integer $code
     * @return void
     * @throws InvalidArgumentException
     */
    public function set(int $code)
    {
        if (!in_array($code, [100, 101, 102, 200, 201, 202, 203, 204, 205, 206, 207, 208, 300, 301, 302, 303, 304, 305, 306, 307, 308, 400, 401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 418, 420, 422, 426, 429, 431, 449, 451, 500, 501, 502, 503, 504, 505, 509])) {
            throw new InvalidArgumentException('error.http.code.notFound');
        }

        $this->code = $code;
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function add(): void
    {
        http_response_code($this->code);
    }
}
