<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Security;


final class Hash
{
    public static function hash($string)
    {
        return password_hash($string, PASSWORD_BCRYPT, 10);
    }
}