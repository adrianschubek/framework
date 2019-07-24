<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Security;


final class Filter
{
    /** FIlter eine Variable / Array
     * @param string|array &$var
     * @return void
     */
    public static function filterString(&$var)
    {
        if (is_array($var)) {
            $var = filter_var_array($var, FILTER_SANITIZE_STRING);
        } else {
            $var = filter_var($var, FILTER_SANITIZE_STRING);
        }
    }
}