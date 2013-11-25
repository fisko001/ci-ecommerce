<?php
 /**
 * Email Contents - Controller
   @rudra shrestha - rusagar.oom
 */
class Emails_model extends CI_Model{

        protected $table_name;

        public function __construct(){
                parent::__construct();
                $this->table_name = 'status_emails';
        }

        /**
         * Post a new email content
         * 
         * @param type $data
         * @return type 
         */
        public function add_new_email(){
            $data = $this->input->post();
            $this->db->insert($this->table_name, $data);
        }
		
        /**
         * Function for get all data of email pages 
         */
        public function getEmailContentData(){
            $query = $this->db->get($this->table_name);
            return $query->result_array();
        }
		
        /**
         *Function for the getEmailById 
         */
        public function getEmailById($id){
            $this->db->where('email_id',$id);
            $query = $this->db->get($this->table_name);
            return $query->row();
        }
		
        /**
         *Function for the update the email content 
         */
        public function update_email($id){
            $data = $this->input->post();
            $this->db->where('email_id',$id);
            $this->db->update($this->table_name, $data);
        }
}
