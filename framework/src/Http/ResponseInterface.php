<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Http;


interface ResponseInterface
{

    function statusCode(int $httpStatus);

    function contentType(string $type);

    function body($body);

    function header(string $name, string $value);

    function cookie(string $name, string $value, int $expires);

    function send();

    function json(string $body);

    function image(string $filepath);
}