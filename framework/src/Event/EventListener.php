<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Event;

/**
 * Event Klasse
 * @package Framework\Event
 */
class EventListener
{
    /** Name des Events
     * @var string
     */
    private $name;

    /** Status ob Event aktiviert
     * @var string
     */
    private $status = true;

    /** Callback Funktion
     * @var callable
     */
    private $callback;

    /**
     * Event constructor.
     * @param $name string
     * @param $callback callable
     */
    public function __construct($name, $callback)
    {
        $this->name = $name;
        $this->callback = $callback;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }

    /**
     * @param callable $callback
     */
    public function setCallback(callable $callback): void
    {
        $this->callback = $callback;
    }
}