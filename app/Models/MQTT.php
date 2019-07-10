<?php

namespace App\Models;

use Framework\Logger\Logger;
use sskaje\mqtt\Message\PUBLISH;
use sskaje\mqtt\MessageHandler;

/**
 * Copyright (c) 2019. Adrian Schubek.
 */
class MQTT extends MessageHandler
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
        set_time_limit(50000000); //
        $this->logger->info(sprintf("Listening... (MAX_EXEC_TIME=%s)", ini_get('max_execution_time')));
//        $this->homeController = $homeController;
    }

    public function publish($mqtt, PUBLISH $publish_object)
    {
        $topic = $publish_object->getTopic();
        $msg = $publish_object->getMessage();

        file_put_contents(ROOT . "/app/Cache/test.txt", $msg);

        $this->logger->info(sprintf("[MQTT] %s: %s", $topic, $msg));
    }
}