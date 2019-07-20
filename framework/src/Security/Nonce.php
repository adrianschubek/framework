<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Security;


use Exception;

final class Nonce
{
    /** Erstellt ein Nonce mit der Zeitspanne und fügt es zur Session hinzu.
     * @param int $length
     * @param bool $hex = true
     * @param string|null $timestamp
     * @return string
     */
    public static function generate(int $length = 16, bool $hex = true, string $timestamp = null)
    {
        try {
            if ($hex === true) {
                return bin2hex(random_bytes($length));
            }
            return random_bytes($length);
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function validate(string $nonce)
    {
        return;
    }


}