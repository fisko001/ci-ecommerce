<?php
 /**
   @rudra shrestha - rusagar.oom
 */

require_once 'ion_auth_model.php';

class Admin_model extends Ion_auth_model
{
    public function __construct() 
    {
        parent::__construct();
        
        $this->tables  = $this->config->item('tables_admins', 'ion_auth');
        $this->columns = $this->config->item('columns_admins', 'ion_auth');
        $this->_extra_where = array('user_type' => 'admin');
        $this->_extra_set = array('user_type' => 'admin');
    }
}