<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace App\Controllers;


use Framework\Controller\Controller;
use Framework\Facades\Cache;
use Framework\Facades\Response;

class CacheTestController extends Controller
{
    public function show()
    {
        $body = Cache::push("test47700", function () {
            $x = 0;
            for ($i = 0; $i < 100000000; $i++) {
                $x += $i;
            }
            return $x;
        }, 7200);

        $this->response->body($body);
    }

    public function allFunc()
    {
        $body = Cache::push("allFunc", function () {
            return json(get_defined_functions(), 1);
        }, 7200);

        $this->response->json($body);
    }

    public function clearCache()
    {
        Cache::clear();

        $this->response->body("Cache geleert");
    }
}