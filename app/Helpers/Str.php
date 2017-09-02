<?php

/**
 * The str_limit function limits the number of characters in a string.
 *
 * @param $str
 * @param $size
 * @param $end
 *
 * @return string
 */
if (!function_exists('str_limit_words')) {
    function str_limit_words($str, $size = 100, $end = '...')
    {
        return mb_substr($str, 0, mb_strrpos(mb_substr($str, 0, $size, 'utf-8'), ' ', 'utf-8'), 'utf-8') . ' ' . $end;
    }
}


/**
 * The str_limit function limits the number of characters in a string.
 *
 * @param $str
 * @param $size
 * @param $end
 *
 * @return string
 */
if (!function_exists('str_strip_limit_words')) {
    function str_strip_limit_words($str, $size = 100, $end = '...')
    {
        return str_limit_words(strip_tags($str), $size, $end);
    }
}
