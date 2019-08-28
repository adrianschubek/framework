<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Session;


class Session implements SessionInterface
{
    private $name;
    private $lifetime;

    /**
     * Session constructor.
     * @param $name
     * @param $lifetime
     */
    public function __construct(string $name, int $lifetime)
    {
        $this->name = $name;
        $this->lifetime = $lifetime;
    }

    /**
     * Startet eine Session, falls keine existiert
     */
    public function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start([
                "name" => "Quiz",
                "cookie_lifetime" => 10800
            ]);
        }
    }
}