<?php
 /**
 * User Page - Controller
   @rudra shrestha - rusagar.oom
 */

defined('BASEPATH') or die('No direct Script Access');
require_once APPPATH . 'libraries/Admin_controller.php';

class Users extends Admin_controller
{

        public function __construct()
        {
                parent::__construct();
                $this->restricted_pages = array( 'create', 'edit', 'approve', 'index', 'edit', 'view', 'search_result','search', 'export');
                
                $this->load->model('user_model');
        }

        /**
         * User listing
         * 
         * @param type $page_number 
         */
        public function index($page_number = 1)
        {
                $page_number = (int) $page_number;
                if ($page_number == 0)
                        $page_number = 1;
                $this->config->load('pagination_options', TRUE);
                $config = $this->config->item('pagination_options');
                
                $config['base_url'] = site_url('admin/users/index/');
                $config['total_rows'] = $this->user_model->get_user_count();
                $config['per_page'] = 20;
                $config['uri_segment'] = 4;
                $this->load->library('pagination', $config);
                $limit = $config['per_page'];
                $offset = $limit * ($page_number - 1);
              
                $data['users'] = array();
                $data['search_term'] = '';
                foreach($this->user_model->get_users(abs($limit), abs($offset)) as $s)
                {
                     $data['users'][] = $s;
                }
                $this->template->set('title', 'Users');
                $this->pagination->initialize($config);
                
                $this->template->load('templates/admin/brainlight', 'admin/users/index', $data);
        }
        
        public function edit($user_id = FALSE)
        {
                if (!$user_id)
                        show_404();
						
                $this->load->model('user_model');
				
                // Lets define both success and error to false
                $data['errors'] = FALSE;
                $data['success'] = FALSE;
                if ($this->input->post('update'))
                {
                        $this->load->library('form_validation');
                        $this->load->config('admin_forms_validations');
                        
                        $rules = $this->config->item('users/edit', 'admin_forms_validations');
                        $this->form_validation->set_rules($rules);
                        if ($this->form_validation->run())
                        {
                                $id = $this->input->post('user_id');
				$update_data['id'] = $id;
                                $update_data['active'] = $this->input->post('status');
                                $update_data['first_name'] = $this->input->post('first_name');
                                $update_data['last_name'] = $this->input->post('last_name');
                                $update_data['title'] = $this->input->post('title');
                                $update_data['email'] = $this->input->post('email');
                                $update_data['username'] = $this->input->post('email');
								
				$data['success'] = TRUE;
								
								
                        
                                if ($this->user_model->update($update_data))
                                {
                                        $data['success'] = TRUE;
										
                                }
                                else
                                {                               
                                        $data['errors'][] = $this->user_model->errors();                           
                                }
                        }
                        else
                        {
                                $data['errors'][] = validation_errors();
                        }

                }
                
                if ($data['userinfo'] = $this->user_model->get_user($user_id))
                {                       
                        $this->template->set('title', 'Edit User');
                        $this->template->load('templates/admin/brainlight', 'admin/users/edit', $data);
                }
                else
                {
                        show_404();
                }
        }
        
        public function search()
        {
                $search_term = $this->input->post('term');
                redirect(site_url('admin/users/search_result/' . urlencode($search_term)), 'refresh');
        }
        
        public function search_result($search_term = '',$page_number=1)
        {
                $search_term = mysql_real_escape_string(urldecode($search_term));
                $page_number = (int) $page_number;
                if ($page_number == 0)
                        $page_number = 1;
                $this->config->load('pagination_options', TRUE);
                $config = $this->config->item('pagination_options');

                $config['base_url'] = site_url('admin/users/search_result/'.$search_term);
                
                $config['per_page'] = 20;
                $config['uri_segment'] = 5;
                $limit = $config['per_page'];
                $offset = $limit * ($page_number - 1);
               // $this->load->model(array('parameters/job_types','parameters/practice_areas'));
                $data['users'] = $this->user_model->get_users($limit, $offset, $search_term);
                $data['search_term'] = $search_term;
                $config['total_rows'] = $this->user_model->num_rows;
                $this->load->library('pagination', $config);
                $this->template->set('title', 'Users');
                $this->template->load('templates/admin/brainlight', 'admin/users/index', $data);
        }
        
        /**
         * Logs the admin to the user account of recruiter to allow unrestricted access
         * 
         */
        public function view($seeker_id)
        {
                if ($seeker = $this->user_model->get_user($seeker_id))
                {
                        $_SESSION['id'] = $seeker['id'];
                        $_SESSION['user_id'] = $seeker['id'];
                        $_SESSION['email'] = $_SESSION['email'] . '[' . $seeker['email'] . ']';
                        $_SESSION['group_id'] = $seeker['group_id'];
                        $_SESSION['group'] = $seeker['group'];
                        $_SESSION['user_type'] = $seeker['user_type'];
                        redirect(seeker_dashboard_url(), 'refresh');
                }
        }
        
        public function export($search_term = FALSE)
        {
                if ($search_term)
                        $search_term = urldecode($search_term);
                        // get the recruiter export query object
                if (empty($search_term))
                        $search_term = FALSE;
                $query = $this->user_model->export_query($search_term);
                $this->load->database();
                header("Content-type: application/excel");
                header("Content-Disposition: attachment; filename=\"export.xls\"");
                echo "UserID\tTitle\tFirst name\tLast Name\tE-mail\tExperience\tJob Type\tPractice Area\tLast Login\t\n";
                if ($query)
                {
                        while ($user_data = mysql_fetch_assoc($query))
                        {
                                printf("%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t\n", $user_data['id'], $user_data['title'], $user_data['first_name'], $user_data['last_name'], $user_data['email'], $user_data['user_type'], ((bool) $user_data['last_login']) ? date('g:ia d/m/Y', $user_data['last_login']) : 'Never Logged in');
                        }
                }
                exit();
        }

}
