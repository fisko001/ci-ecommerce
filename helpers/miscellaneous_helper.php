<?php
/**
 * This applies to public site, elaw seek site, and recruiter site only
 */
if(!function_exists('debug'))
 {
   function debug($arr)
    {
		 echo "<pre>";
		 print_r($arr);
		 echo "</pre>";
	}	 
 }
 
 
 if(!function_exists('valid_url'))
 { 
function valid_url($str){

           $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
            if (!preg_match($pattern, $str))
            {
                return FALSE;
            }
            return TRUE;
    }   
 }
 if(!function_exists('br2nl'))
 { 
function br2nl($str){
	   $str=stripslashes($str);
	    $str=str_replace("<br>","",$str); 
	   return  str_replace("<br />","",$str); 
		  
    }   
 }
 
