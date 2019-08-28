<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Utility;


class Url
{
    /** Prüft, ob $text in URL ist
     * @param $text
     * @return bool
     */
    public static function inUrl($text)
    {
        return strpos($_SERVER["REQUEST_URI"], $text) !== false;
    }

    /** Prüft, ob $text mit der URl übereinstimmt
     * @param string $text
     * @return bool
     */
    static function isUrl($text)
    {
        return $_SERVER["REQUEST_URI"] === $text;
    }

}