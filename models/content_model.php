<?php
 /**
 * Cms Page - Model
   @rudra shrestha - rusagar.oom
 */

class Content_model extends CI_Model{

        protected $table_name;

        public function __construct(){
                parent::__construct();
                $this->table_name = 'cms_pages';
        }

        /**
         * Post a new page
         * 
         * @param type $data
         * @return type 
         */
        public function add_new_page(){
            $data = $this->input->post();
            $this->db->insert($this->table_name, $data);
        }
		
        /**
         * Function for get all data of cms pages 
         */
        public function getContentData(){
            $query = $this->db->get($this->table_name);
            return $query->result_array();
        }
		
        /**
         *Function for the getPagesById 
         */
        public function getPagesById($id){
            $this->db->where('id',$id);
            $query = $this->db->get($this->table_name);
            return $query->row();
        }
		
        /**
         *Function for the update the pages 
         */
        public function update_page($id){
            $data = $this->input->post();
            $this->db->where('id',$id);
            $this->db->update($this->table_name, $data);
        }        

}
