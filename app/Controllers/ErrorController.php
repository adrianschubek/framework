<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace App\Controllers;


use Framework\Controller\Controller;

class ErrorController extends Controller
{
    public function notFound($args)
    {
        $this->response->setStatusCode(404);
        $this->logger->warn(sprintf("File not found: %s", $args));
        $this->response->send();
    }

    public function notAllowed($args)
    {
        $this->response->setStatusCode(405);
        $this->logger->warn(sprintf("Method not allowed: %s", $args));
        $this->response->send();
    }
}