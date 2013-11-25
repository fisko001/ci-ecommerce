<?php
defined('BASEPATH') or die('No direct Script Access');

/**
 * Loads Jquery Jquery UI, and other js resources as per called
 */
if (!function_exists('_include_js'))
{
    /**
     * Base function to be used by other js include functions
     * 
     * @access Private
     */
    function _include_js($resource)
    {
        $CI =  & get_instance();
        $CI->load->config('assets', TRUE);
        $assets = $CI->config->item('assets');
        $js_url = $assets[$resource];
        return "<script src=\"$js_url\"  type=\"text/javascript\"></script>";
    }
}


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

if (!function_exists('include_jquery'))
{
    /**
     * Returns jquery include
     * 
     * @return string jquery script include
     */
    function include_jquery()
    {
        return _include_js('jquery_url');
    }
}


if (!function_exists('include_jquery_ui'))
{
    /**
     * Returns jquery ui script tag
     * 
     * @return string Jquery UI inlcude
     */
    function include_jquery_ui()
    {
        return _include_js('jquery_ui_url');
    }
}


if (!function_exists('include_jquery_ui_css'))
{
     /**
     * Returns Jqiuery UI CSS
     * 
     * @return string css include
     */
    function include_jquery_ui_css()
    {
        return _include_css('jquery_ui_css');
    }
}

if ((!function_exists('include_jqtransform')))
{
    /**
     *  JqTransform
     * @return String JQtransform
     */
    function include_jqtransform()
    {
        return _include_js('jqtransform_url');
    }
}


if (!function_exists('include_datatables_js'))
{
    function include_datatables_js()
    {
        return _include_js('datatables_js');
    }
}