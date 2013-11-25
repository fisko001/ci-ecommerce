<?php
class Password_requested_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
     * function for get_page_by_permalink
     */
    public function insert_info($email_id)
    {
        $insertArr = array('pass_request_user_id'=>$email_id , 'requested'=>'1');
        $this->db->insert('password_request',$insertArr);
    }
    
    public function check_password_request($email)
    {
        $this->db->where('pass_request_user_id',$email);
        $this->db->where('requested','1');
        $query = $this->db->get('password_request');
        return $query->num_rows();
    }
    public function update_pass($email)
    {
        $this->db->where('pass_request_user_id',$email);
        $this->db->delete('password_request');
    }
}

?>