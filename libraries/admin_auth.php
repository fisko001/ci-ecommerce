<?php

require_once 'Ion_auth.php';

class Admin_auth extends Ion_auth
{
    public function __construct() 
    {
        parent::__construct();
        $this->ci->load->model('admin_model','ion_auth_model');
        $this->user_type = 'admin';
        $this->_extra_where = array('user_type' => 'admin');
        if (!$this->logged_in() && get_cookie('identity') && get_cookie('remember_code'))
        {
                $this->ci->admin_auth = $this;
                $this->ci->ion_auth_model->login_remembered_user();
        }
    }
}