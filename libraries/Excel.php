<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
* Excel library for Code Igniter applications
* Author: Derek Allard, Dark Horse Consulting, www.darkhorse.to, April 2006
*/
class Excel{
	
	private $headers = ''; // just creating the var for field headers to append to below
	private $data = ''; // just creating the var for field data to append to below
		 
	 public function __construct(){  
		$this->CI =& get_instance();
		$this->CI->load->helper('download');
	 }
	 

	public function to_excel($query, $filename='exceloutput',$headers_labels=NULL)
    {
         
		 $char_encoding = 'windows-1255';
    
         $headers = ''; // just creating the var for field headers to append to below
         $data = ''; // just creating the var for field data to append to below
         
       if($headers_labels != NULL):
     
              foreach ($headers_labels as $field):
                  $headers .= iconv(mb_detect_encoding($field),$char_encoding,$field) . "\t";
              endforeach;
		endif;
         
       foreach ($query as $row) {
                   $line = '';
                   foreach($row as $value) {                                            
                        if (( ! isset($value)) OR ($value == "")) {
                             $value = "\t";
                        } else {
                             $value = str_replace('"', '""', $value);
                             $value = '"' . $value . '"' . "\t";
                             
                             $value = iconv(mb_detect_encoding($value),$char_encoding,$value);
                        }
                        $line .= $value;
                   }
                   $data .= trim($line)."\n";
              }
              
              $data = str_replace("\r","",$data);
              force_download($filename . ".xls", $headers . "\n" . $data);
         }
}


/* End of file excel_helper.php */
/* Location: ./application/helpers/excel_helper.php */ 
?>