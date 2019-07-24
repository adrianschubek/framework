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
        $this->response->setBody($this->render("error.html"));
        $this->logger->warn(sprintf("File not found: %s", $args));
        $this->sendResponse();
    }

    public function notAllowed($args)
    {
        $this->response->setStatusCode(405);
        $this->response->setBody($this->render("error.html"));
        $this->logger->warn(sprintf("Method not allowed: %s", $args));
        $this->sendResponse();
    }
}