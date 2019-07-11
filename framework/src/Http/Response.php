<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Http;


class Response implements ResponseInterface
{
    protected $url;

    protected $cookies = [];

    protected $method;

    protected $headers = [];

    protected $body;

    protected $files;

    protected $contentType = null;

    protected $statusCode;

    public function setStatusCode(int $httpStatus)
    {
        switch ($httpStatus) {
            default:
            case 200:
                $this->statusCode = "HTTP/1.1 200 OK";
                break;
            case 400:
                $this->statusCode = "HTTP/1.1 400 Bad Request";
                break;
            case 401:
                $this->statusCode = "HTTP/1.1 400 Unauthorized";
                break;
            case 403:
                $this->statusCode = "HTTP/1.1 403 Forbidden";
                break;
            case 404:
                $this->statusCode = "HTTP/1.1 404 Not Found";
                break;
        }
    }

    final public function send()
    {

        ob_start();

        foreach ($this->headers as $header) {
            header($header);
        }
        echo $this->body;
        if (isset($this->contentType)) {
            header(sprintf("Content-type: %s", $this->contentType));
        }

        ob_end_flush();
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

}