<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Utility;


class Url
{
    /** Checks if $text is in URl
     * @param string $text
     * @return bool
     */
    public static function is($text)
    {
        return $_SERVER["REQUEST_URI"] === $text;
    }

    /** Checks if $text === URL
     * @param $text
     * @return bool
     */
    public function in($text)
    {
        return strpos($_SERVER["REQUEST_URI"], $text) !== false;
    }

}