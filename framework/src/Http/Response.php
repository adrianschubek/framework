<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Http;


class Response implements ResponseInterface
{
    protected $cookies = [];

    protected $method;

    protected $headers = [];

    protected $body;

    protected $files;

    protected $contentType = null;

    protected $statusCode;

    public function setStatusCode(int $httpStatus)
    {
        $this->statusCode = http_response_code($httpStatus);
    }

    public function setContentType(string $type)
    {
        $this->contentType = $type;
    }

    function setBody($body)
    {
        $this->body = $body;
    }

    function setHeader(string $name, $value)
    {
        $this->headers[$name] = $value;
    }

    function setCookie(string $name, string $value, int $expires)
    {
        setcookie($value, $value, $expires);
    }

    final public function send()
    {
        ob_start();

        foreach ($this->headers as $header) {
            header($header);
        }
        echo $this->body;
        if (isset($this->contentType)) {
            header(sprintf("Content-Type: %s", $this->contentType));
        }
        if (isset($this->statusCode)) {
            header($this->statusCode);
        }

        ob_end_flush();
    }

}