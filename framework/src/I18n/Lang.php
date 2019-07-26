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

    public static function get(string $)
    {

    }

    /**
     * @param string $lang Sprache z.B. "de"
     * @param string|array $data Pfad zur Datei oder String Array
     */
    public static function add(string $lang, $data)
    {
        if (is_array($data)) {
            self::$strings[$lang] = $data;
        }
    }

    /**
     * @param string $lang
     * @param string $filename
     */
    public static function addFromFile(string $lang, string $filename)
    {
        $path = ROOT . sprintf("/app/Lang/%s/%s", toLower($lang), toLower($filename));
        if (file_exists($path)) {
            $content = (include $path);
        } else {
            /** TODO:  */
        }
    }

    public static function get()
}