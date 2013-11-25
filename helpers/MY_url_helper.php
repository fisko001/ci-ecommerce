<?php

/**
 * Extends URL Helper
 */


if (!function_exists('admin_dashboard_url'))
{
    function admin_dashboard_url () 
    {
        $CI = & get_instance();
        return $CI->config->site_url($CI->config->item('admin_dashboard_url'));
    }
}


function theme_url($uri)
{
	$CI =& get_instance();
	return $CI->config->base_url('application/themes/'.$CI->config->item('theme').'/'.$uri);
}

//to generate an image tag, set tag to true. you can also put a string in tag to generate the alt tag
function theme_img($uri, $tag=false)
{
	if($tag)
	{
		return '<img src="'.theme_url('assets/img/'.$uri).'" alt="'.$tag.'">';
	}
	else
	{
		return theme_url('assets/img/'.$uri);
	}
	
}

function theme_js($uri, $tag=false)
{
	if($tag)
	{
		return '<script type="text/javascript" src="'.theme_url('assets/buyshop_theme/buyshop_js/'.$uri).'"></script>';
	}
	else
	{
		return theme_url('assets/buyshop_theme/buyshop_js/'.$uri);
	}
}

//you can fill the tag field in to spit out a link tag, setting tag to a string will fill in the media attribute
function theme_css($uri, $tag=false)
{
	if($tag)
	{
		$media=false;
		if(is_string($tag))
		{
			$media = 'media="'.$tag.'"';
		}
		return '<link href="'.theme_url('assets/buyshop_theme/buyshop_styles/'.$uri).'" type="text/css" rel="stylesheet" '.$media.'/>';
	}
	
	return theme_url('assets/buyshop_theme/buyshop_styles/'.$uri);
}