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
        $this->response->statusCode(404);
        $this->response->body($this->render("error.html"));
        $this->logger->warn(sprintf("File not found: %s", $args));
        $this->send();
    }

    public function notAllowed($args)
    {
        $this->response->statusCode(405);
        $this->response->body($this->render("error.html"));
        $this->logger->warn(sprintf("Method not allowed: %s", $args));
        $this->send();
    }
}