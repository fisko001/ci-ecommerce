<?php
require_once 'ion_auth_model.php';
class User_model extends Ion_auth_model
{
        public $search_like = array();
        public $num_rows;
        public function __construct()
        {

                parent::__construct();
                $this->tables = $this->config->item('tables_users', 'ion_auth');
  
        }

        /*
         * Update user info.
         */
        public function update($update_data)
        {
 
 				$update_users = array(
                                                            'id' => $update_data['id'],
                                                            'title' => $update_data['title'],
                                                            'username' => $update_data['username'],
                                                            'first_name' => $update_data['first_name'],
                                                            'last_name' => $update_data['last_name'],
                                                            'email' => $update_data['email']
                                                            );				

				$this->db->where('id', $update_users['id']);
                $this->db->update('users', $update_users);
        }

         /*
         * Fucntion for unique username 
         */
        function userUserCheck($username)
        {

                $this->db->where(array('group_id' => '2', 'username' => $username));
                $query = $this->db->get('users');
                return $query->num_rows();
        }
        
        
		/* get User info*/
        public function get_user($id)
        {
  
                $query = "SELECT users.id,
                                users.title,
                                users.first_name,
                                users.last_name,
                                users.email,
                                users.active,
                                users.user_type,
                                users.last_login FROM users where id='$id'";
                $exec = $this->db->query($query);                
                return $exec->num_rows() > 0 ? $exec->result_array() : array();
        }
        
         public function get_user_count()
        {
  
                $query = "SELECT count(*) as num_rows from users";
                $exec = $this->db->query($query);     
                return $this->db->query($query)->row()->num_rows; 
        }

        
         /*
         * List users 
         */
        public function get_users($limit, $offset, $search_term = FALSE)
        {

                $count_query = "SELECT count(*) as num_rows from users";

                $query = "SELECT users.id,
                                users.title,
                                users.first_name,
                                users.last_name,
                                users.email,
                                users.active,
                                users.user_type,
                                users.last_login FROM users";

                if ($search_term)
                {

                        $search_term = mysql_real_escape_string($search_term);
                        $query .= " WHERE
                                        (
                                        first_name LIKE '%{$search_term}%' 
                                        OR
                                        last_name LIKE '%{$search_term}%' 
                                        OR
                                        email LIKE '%{$search_term}%' 
                                        OR
                                        CONCAT_WS(' ',users.first_name,users.last_name) LIKE '%{$search_term}%'                                     
                                        )";

                        $count_query .= " WHERE 
                                        (
                                        first_name LIKE '%{$search_term}%' 
                                        OR
                                        last_name LIKE '%{$search_term}%' 
                                        OR
                                        email LIKE '%{$search_term}%'                                                                            
                                        OR
                                        CONCAT_WS(' ',users.first_name,users.last_name) LIKE '%{$search_term}%'                                      
                                        )";
                }
               
                    $query .= " LIMIT $offset, $limit";
                
                    
                $this->num_rows = $this->db->query($count_query)->row()->num_rows; 
                $exec = $this->db->query($query);                
                return $exec->num_rows() > 0 ? $exec->result_array() : array();

        }

        /**

         * Exporting the users to the CSV, excel
         * @param type $search_term
         * @return type
         */

        public function export_query($search_term = FALSE)
        {
                $query = "SELECT users.id,
                                users.title,
                                users.first_name,
                                users.last_name,
                                users.email,
                                users.last_login,
                                users.user_type
                        FROM
                        users
                        ";

                if ($search_term)
                {
                        $search_term = mysql_real_escape_string($search_term);
                        $query .= " WHERE
                                        (
                                        first_name LIKE '%{$search_term}%' 
                                        OR
                                        last_name LIKE '%{$search_term}%' 
                                        OR
                                        email LIKE '%{$search_term}%'

                                        OR
                                        CONCAT_WS(' ',users.first_name,users.last_name) LIKE '%{$search_term}%'                                     
                                        )";

                }
                // couldn't find other way around 
                return mysql_query($query);
        }
}
