<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Security;


class CsrfToken
{
    public static function get() {
        return $_SESSION[cfg("session.csrf_name")];
    }
}