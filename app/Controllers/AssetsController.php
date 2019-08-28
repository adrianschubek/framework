<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace App\Controllers;


use Framework\Controller\Controller;

class AssetsController extends Controller
{
    public function loadAssets($path)
    {
        $fullpath = ROOT . "/public/assets/$path";
        $this->logger->debug($fullpath);
        if (!file_exists($fullpath)) {
            $this->logger->warn("File not found: /assets/$path");
            return;
        }


//        $this->response->setContentType(mime_content_type($fullpath));
        $this->logger->debug($fullpath);
//        $this->logger->debug(mime_content_type($fullpath));
        $this->response->body(file_get_contents($fullpath));
        $this->logger->info("-> /assets/$path");
        $this->response->send();
//        $this->logger->debug(__METHOD__ . ROOT . "/public/assets/$path");
    }
}