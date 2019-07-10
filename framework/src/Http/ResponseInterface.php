<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Http;


interface ResponseInterface
{

    function setStatusCode(int $httpStatus);

    function setContentType(string $type);

    function setBody($body);

    function setHeader(string $name, string $value);

    function setCookie(string $name, string $value, int $expires);

    function send();
}