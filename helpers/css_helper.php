<?php

/*
 * Loads CSS Resources as per needed
 * 
 * @author Nitesh<nitesh@nitesh.com.np>
 */

if (!function_exists('_include_css'))
{
    /**
     *
     * @param type $resource resource url
     * @return link href
     */
    function _include_css($resource)
    {
        $CI =  & get_instance();
        $CI->load->config('assets', TRUE);
        $assets = $CI->config->item('assets');
        $css_url = $assets[$resource];
        return "<link href=\"$css_url\" type=\"text/css\" rel=\"stylesheet\" />";
    }
}


if (!function_exists('admin_main_css'))
{
    /**
     * Returns required markup for admin main css file
     * 
     * @return link href
     */
    function admin_main_css()
    {
        return _include_css('admin_main_css');
    }
}
?>
