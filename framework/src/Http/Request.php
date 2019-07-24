<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Http;

use Locale;

class Request implements RequestInterface
{
    protected $url;

    protected $cookies = [];

    protected $method;

    protected $headers = [];

    protected $body;

    protected $files;

    protected $server;

    protected $session;

    /**
     * Request constructor.
     * @param string|null $url
     * @param array|null $cookies
     * @param string|null $method
     * @param array|null $headers
     * @param null $body
     * @param array|null $files
     * @param array|null $server
     * @param array|null $session
     */
    public function __construct(
        string $url = null,
        array $cookies = null,
        string $method = null,
        array $headers = null,
        $body = null,
        array $files = null,
        array $server = null,
        array $session = null
    )
    {
        if (php_sapi_name() !== "cli") {
            $this->url = $url ?? $_SERVER['REQUEST_URI'];
            $this->cookies = $cookies ?? $_COOKIE;
            $this->method = $method ?? $_SERVER['REQUEST_METHOD'];
            if (function_exists("getallheaders")) {
                $this->headers = getallheaders();
            }
            $this->body = $body ?? file_get_contents("php://input");
            $this->files = $files ?? $_FILES;
            $this->server = $server ?? $_SERVER;
            $this->session = $session ?? $_SESSION ?? null;
        }
    }

    public function getUrl(): string
    {
        return $this->url ?? "";
    }

    public function getAcceptLang(): string
    {
        return Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    }

    public function getCookies(): array
    {
        return $this->cookies;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function hasHeader(string $header): bool
    {
        return isset($this->headers["HTTP_$header"]);
    }

    public function getHeader(string $header): bool
    {
        // TODO: Implement getHeader() method.
    }
}