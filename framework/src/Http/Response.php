<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
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

    public function statusCode(int $httpStatus)
    {
        $this->statusCode = http_response_code($httpStatus);
    }

    public function header(string $name, $value)
    {
        $this->headers[$name] = $value;
    }

    public function cookie(string $name, string $value, int $expires)
    {
        setcookie($name, $value, $expires);
    }

    public function send()
    {
        ob_start();

        if (!empty($this->headers)) {
            foreach ($this->headers as $header) {
                header($header);
            }
        }
        if (!empty($this->contentType)) {
            header(sprintf("Content-Type: %s", $this->contentType));
        }
        if (!empty($this->statusCode)) {
            header($this->statusCode);
        }
        echo $this->body;

        ob_end_flush();
    }

    public function json(string $json, bool $prettyPrint = false)
    {
        $this->contentType("application/json");
        $this->body($json);
    }

    public function contentType(string $type)
    {
        $this->contentType = $type;
    }

    public function body($body)
    {
        $this->body = $body;
    }

    public function image(string $filepath)
    {
        // TODO: Implement image() method.
    }
}