<?php

namespace Transip\Api\CLI\Utilities;

class Strings
{
    /**
     * Equivalent to the strpos function with the difference that it uses an array as a second parameter that allows
     * the check of several words rather than just one.
     *
     * @param $haystack
     * @param $needle
     * @return bool|false|int
     */
    public static function strpos_arr(string $haystack, array $needle)
    {
        if (!is_array($needle)) {
            $needle = array($needle);
        }
        foreach ($needle as $what) {
            if (($pos = strpos($haystack, $what))!==false) {
                return $pos;
            }
        }
        return false;
    }
}
