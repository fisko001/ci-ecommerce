<?php

defined('BASEPATH') or die('No direct Script Access');


class Admin_controller extends CI_Controller{

    public $restricted_pages = array();

    public function __construct(){
        parent::__construct();
        session_start();
        session_regenerate_id();
        $this->load->library('admin_auth');
    }

    /**
     * Remaps and Permission and login checks
     * 
     * @param string $method
     * @param type $params
     * @return type 
     */
    public function _remap($method, $params = array()){
        isset($_SESSION) or session_start();

        if (in_array($method, $this->restricted_pages)){
            if (!$this->admin_auth->logged_in())
            {
                redirect('admin/administration/login/?redirect_url=' . current_url());
            }
        }
        if (method_exists($this, $method))
        {
            return call_user_func_array(array($this, $method), $params);
        }
        show_404();
    }

}