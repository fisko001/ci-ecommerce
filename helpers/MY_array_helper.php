<?php

	function array_flatten($multi)
	 {
		 $result = array(); 
		 foreach($multi as $submulti)
		 {
			  foreach($submulti as $subsubmulti)
			   {
				  $result[] = $subsubmulti; 
			   }
		 }
		 
		 return $result;
	}