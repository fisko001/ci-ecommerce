<?php  defined('BASEPATH') or die('No Direct Script Access Allowed');
/**
* Name:  File
*
* Author: Nitesh Pandey
*        nitesh@nitesh.com.np
*        nitesh@ebpearls.com
*
*
* Created:  23.01.2011
*
* Description : Library for bizelaw File management
* Depends on : Community Contributed code for force_download with resume capability
*
* Requirements: PHP5 or above
*
*/
class File
{
    protected $ci;
    
    protected $invoices_path = '';
    
    protected $application_attachments_path = '';
    
    protected $entity_attachments_path = '';
    
    public $directory_path;
    
    protected $file_types = array('invoices', 'application_attachments', 'entity_attachments');
    /**
     *
     * @var int id of file in the database
     */
    protected $file_id;
    /**
     *
     * @var type file path in the directory chosen
     */
    public $file_path;
    /**
     *
     * @var type File name
     */
    public $file_name;

    public function __construct($config = array())
    {
        $this->ci = & get_instance();
        //print_r($config);
        if (count($config) > 0)
        {
                $this->initialize($config);
        }
        else
        {
            // initialize default values
        }
        
        $this->ci->load->model('file_model');
        log_message('debug', "File Class Initialized");
    }
    
    
    /**
     * Initializes different config parameters
     * 
     * @param type $config
     * @return File 
     */
    public function initialize($config = array())
    {
            foreach ($config as $key => $val)
            {
                
                    if (isset($this->$key))
                    {
                            $method = 'set_'.$key;

                            if (method_exists($this, $method))
                            {
                                    $this->$method($val);
                            }
                            else
                            {
                                    $this->$key = $val;
                            }
                    }
            }
            return $this;
    }
    /**
     * Forces download with resume support
     * 
     * Community Contribution reused
     * @param type $filename
     * @param type $data
     * @param type $enable_partial
     * @param int $speedlimit
     * @return type 
     */
    public function force_download($filename = '', $file_name= FALSE, $data = false, $enable_partial = true, $speedlimit = 0)
    {
            if ($filename == '')
            {
                    return FALSE;
            }

            if ($data === false && !file_exists($filename))
                    return FALSE;

            // Try to determine if the filename includes a file extension.
            // We need it in order to set the MIME type
            if (FALSE === strpos($filename, '.')) 
            {
                    return FALSE;
            }

            // Grab the file extension
            $x = explode('.', $filename);
            $extension = end($x);

            // Load the mime types
            @include(APPPATH . 'config/mimes' . EXT);

            // Set a default mime if we can't find it
            if (!isset($mimes[$extension])) 
            {
                    if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT']))
                            $UserBrowser = "Opera";
                    elseif (ereg('MSIE ([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT']))
                            $UserBrowser = "IE";
                    else
                            $UserBrowser = '';

                    $mime = ($UserBrowser == 'IE' || $UserBrowser == 'Opera') ? 'application/octetstream' : 'application/octet-stream';
            }
            else 
            {
                    $mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
            }

                    $size = $data === false ? filesize($filename) : strlen($data);

            if ($data === false)
            {
                    $info = pathinfo($filename);
                    $name = $info['basename'];
            } 
            else 
            {
                    $name = $filename;
            }
            if($file_name)
            {
                    $name = $file_name;
            }

            // Clean data in cache if exists
            @ob_end_clean();

            // Check for partial download
            if (isset($_SERVER['HTTP_RANGE']) && $enable_partial) 
            {
                    list($a, $range) = explode("=", $_SERVER['HTTP_RANGE']);
                    list($fbyte, $lbyte) = explode("-", $range);

                    if (!$lbyte)
                        $lbyte = $size - 1;

                    $new_length = $lbyte - $fbyte;

                    header("HTTP/1.1 206 Partial Content", true);
                    header("Content-Length: $new_length", true);
                    header("Content-Range: bytes $fbyte-$lbyte/$size", true);
            }
            else 
            {
                    header("Content-Length: " . $size);
            }

            // Common headers
            header('Content-Type: ' . $mime, true);
            header('Content-Disposition: attachment; filename="' . $name . '"', true);
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT", true);
            header('Accept-Ranges: bytes', true);
            header("Cache-control: private", true);
            header('Pragma: private', true);

            // Open file
            if ($data === false) 
            {
                    $file = fopen($filename, 'r');

                    if (!$file)
                        return FALSE;
            }

            // Cut data for partial download
            if (isset($_SERVER['HTTP_RANGE']) && $enable_partial)
                    if ($data === false)
                            fseek($file, $range);
                    else
                            $data = substr($data, $range);

            // Disable script time limit
            @set_time_limit(0);

            // Check for speed limit or file optimize
            if ($speedlimit > 0 || $data === false) 
            {
                    if ($data === false) 
                    {
                            $chunksize = $speedlimit > 0 ? $speedlimit * 1024 : 512 * 1024;

                    while (!feof($file) and (connection_status() == 0)) 
                    {
                            $buffer = fread($file, $chunksize);
                            echo $buffer;
                            flush();

                            if ($speedlimit > 0)
                                    sleep(1);
                    }

                    fclose($file);
                }
                else 
                {
                        $index = 0;
                        $speedlimit *= 1024; //convert to kb

                        while ($index < $size and (connection_status() == 0)) 
                        {
                                $left = $size - $index;
                                $buffersize = min($left, $speedlimit);

                                $buffer = substr($data, $index, $buffersize);
                                $index += $buffersize;

                                echo $buffer;
                                flush();
                                sleep(1);
                        }
                }
            } 
            else
            {
                    echo $data;
            }
        }
        /**
         *
         * @param type $file_id
         * @return type 
         */
        public function get($file_id = FALSE)
        {
                if( !$file_id )
                    return FALSE;
                $this->ci->load->model('file_model');
                $file_model = $this->ci->file_model;
                
                $file_info = $file_model->get($file_id);
                if (!$file_info)
                {
                    return FALSE;
                }
                else
                {
                    $this->file_path = $this->directory_path . $file_info['file_path'];
                }
                return TRUE;
                
        }
        
        /**
         * Sets the directory path for different types of files in the system
         * 
         * @param type $file_type
         * @return type 
         */
        public function set_file_type($file_type)
        {
            
            if (!in_array($file_type, $this->file_types))
            {
                return FALSE;
            }
            else
            {
                switch ($file_type)
                {
                    case 'invoices':
                        $this->directory_path = $this->invoices_path;
                        break;
                    case 'application_attachments':
                        $this->directory_path = $this->application_attachments_path;
                        break;
                    case 'entity_attachments':
                        $this->directory_path = $this->entity_attachments_path;
                        break;
                }
            }
            if (isset($this->directory_path))
            {
                return TRUE;
            }
        }
        
        /**
         * Downloads file using force_download function
         */
        public function download_file()
        {
            if (!isset ($this->directory_path) OR !isset ($this->file_path) OR !isset ($this->file_name))
            {
                show_404();
                exit();
            }
            else
            {
                echo $this->file_path; exit();
                $this->force_download($this->file_path, $this->file_name);
            }
        }
        
}