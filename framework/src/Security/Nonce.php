<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Security;


final class Nonce
{
    /** Erstellt ein Nonce
     * @param int $length
     * @param bool $hex = true
     * @return string
     */
    public static function generate(int $length = 16, bool $hex = true)
    {
        try {
            if ($hex === true) {
                return bin2hex(random_bytes($length));
            }
            return random_bytes($length);
        } catch (\Exception $ex) {
            return false;
        }
    }


}