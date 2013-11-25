<?php

require_once 'Ion_auth.php';

class Recruiter_auth extends Ion_auth
{
    public function __construct() 
    {
        parent::__construct();
        $this->ci->load->model('recruiter_model','ion_auth_model');
        $this->_extra_where = array('user_type' => 'recruiter');
        $this->user_type = 'recruiter';
        if (!$this->logged_in() && get_cookie('identity') && get_cookie('remember_code'))
        {
                $this->ci->recruiter_auth = $this;
                $this->ci->ion_auth_model->login_remembered_user();
        }
    }
}