<?php
defined('BASEPATH') or die('No direct Script Access');

if (!function_exists('clean_input'))
    {
    function clean_input($input) 
        {
            $search = array(
            '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
            );

            $output = preg_replace($search, '', $input);
            return $output;
        }
    }