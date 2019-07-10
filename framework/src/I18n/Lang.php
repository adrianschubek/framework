<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\I18n;


class Lang
{
    private static $lang;

    private static $strings;

    /** Setzt die Sprache der App
     * @param string $lang
     */
    public static function set(string $lang)
    {
        if (!in_array($lang, cfg("app.lang"))) return;
        self::$lang = $lang;
    }

    /**App ist in Sprache ..?
     * @param string $name
     * @return bool
     */
    public static function is(string $name)
    {
        return self::$lang === $name;
    }

    /**
     * @param string $lang Sprache z.B. "de"
     * @param string|array $data Pfad zur Datei oder Array
     */
    public static function add($lang, $data)
    {
        if (is_array($data)) {
            self::$strings[$lang] = $data;
        } else if (is_string($lang) && file_exists(ROOT . sprintf("/app/Lang/%s", $lang))) {

        }
    }
}