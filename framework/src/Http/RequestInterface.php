<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Http;

interface RequestInterface
{
    public function getUrl(): string;

    public function getAcceptLang(): string;

    public function getCookies(): array;

    public function hasHeader(string $header): bool;

    public function getHeader(string $header): bool;

    public function getHeaders(): array;

    public function getFiles(): array;

    public function getMethod(): string;

    public function getBody();
}