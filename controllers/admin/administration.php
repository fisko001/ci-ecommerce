<?php
 /**
   @rudra shrestha - rusagar.oom
 */
 
defined('BASEPATH') or die('No direct Script Access');

require_once APPPATH . 'libraries/Admin_controller.php';

class Administration extends Admin_Controller
{

        public function __construct()
        {
                parent::__construct();
                $this->restricted_pages = array('dashboard', 'account_settings', 'admin_accounts','update_details', 'new_account','edit_account');
                
                $admin_session_config = array(
		    'sess_cookie_name' => 'admin_session_config',
		    'sess_expiration' => 0
		);
                $this->CI =& get_instance();
		$this->CI->load->library('session', $admin_session_config, 'admin_session');
        }

        /**
         * A call to login
         * 
         */
        public function index(){
                $this->login();
        }

        /**
         * Dashboard Page Entry Point of Admin Area
         */
        public function dashboard()
        {
                $this->template->set('title', "Dashboard");
                $this->template->load('templates/admin/brainlight', 'admin/dashboard');
        }

        /**
         * Logins the admin to admin dashboard
         * 
         * */
        public function login()
        {
                $data['error'] = FALSE;
                $this->template->set('title', 'Login');
                $this->load->library('form_validation');
                if ($this->admin_auth->logged_in())
                {
                        //already logged in so no need to access this page
                        redirect(admin_dashboard_url(), 'refresh');
                }
                if (!$this->input->post('email'))
                {
                        $this->template->load('templates/admin/login-template', 'admin/login', $data);
                }
                else
                {
                        $email = $this->input->post('email');
                        $password = $this->input->post('password');
                        $this->form_validation->set_rules('email', 'Username', 'required|valid_email');
                        $this->form_validation->set_rules('password', 'Password', 'required');

                        if ($this->form_validation->run() == true)
                        {
                                //check to see if the user is logging in
                                //check for "remember me"
                                $remember = (bool) $this->input->post('remember');

                                if ($this->admin_auth->login($email, $password, $remember))
                                {
                                        if (isset($_GET['redirect_url']))
                                        {
                                                redirect($_GET['redirect_url'], 'refresh');
                                        }
                                        else
                                        {
                                                redirect(admin_dashboard_url(), 'refresh');
                                        }
                                }
                                else
                                {
                                        //if the login was un-successful
                                        //redirect them back to the login page
                                        $this->data['error'] = "Invalid username or password";
                                        $this->template->load('templates/admin/login-template', 'admin/login', $this->data);
                                }
                        }
                        else
                        {
                                //the user is not logging in so display the login page
                                //set the flash data error message if there is one
                                $this->data['email'] = array('name' => 'email',
                                    'id' => 'email',
                                    'type' => 'text',
                                    'value' => $this->form_validation->set_value('email'),
                                );
								
                                $this->data['password'] = array('name' => 'password',
                                    'id' => 'password',
                                    'type' => 'password',
                                );
                                $this->data['error'] = "Invalid username or password";
                                $this->template->load('templates/admin/login-template', 'admin/login', $this->data);
                        }
                }
        }

        /**
         * Load Account Settings Page 
         * to change password and change other details
         */
        public function account_settings()
        {
                $data['user'] = $this->admin_auth->get_user();
                $this->template->set('title', 'Account Settings');
                $this->template->load('templates/admin/brainlight', 'admin/account_settings', $data);
        }

        /**
         * Changes Password
         * Only Responds to AJAX POST Request
         */
        public function change_password()
        {
                if ($this->input->is_ajax_request())
                {
                        $current_password = $this->input->post('current_password');
                        $new_password = $this->input->post('new_password');
                        $new_password_confirm = $this->input->post('new_password_confirm');
                        $response = array();
                        if (!$current_password OR !$new_password OR !$new_password_confirm)
                        {
                                $response['error'] = 'All Fields Not Set';
                        }
                        else
                        {
                                if ($new_password != $new_password_confirm)
                                {
                                        $response['error'] = "New Passwords don't match";
                                }
                                else
                                {
                                        if ($this->admin_auth->change_password($_SESSION['email'], $current_password, $new_password))
                                        {
                                                $response['success'] = "Password Changed Successfully";
                                        }
                                        else
                                        {
                                                $response['error'] = "Authentication Failure";
                                        }
                                }
                        }
                        echo json_encode($response);
                }
                else
                {
                        "Access Denied";
                }
        }

        /**
         * Updates Current User Profile (ADMIN)
         * 
         */
        public function update_details()
        {
                if ($this->input->is_ajax_request())
                {
                        $data['title'] = clean_input($this->input->post('title'));
                        $data['first_name'] = clean_input($this->input->post('first_name'));
                        $data['last_name'] = clean_input($this->input->post('last_name'));
                        $data['position'] = clean_input($this->input->post('position'));
                        if ($this->admin_auth->update_user($_SESSION['user_id'], $data))
                        {
                                $response['success'] = 'Details Updated Successfully';
                        }
                        else
                        {
                                $response['error'] = 'Something went wrong!';
                        }
                        echo json_encode($response);
                }
                else
                {
                        "No DIRECT ACESS ALLOWED";
                }
        }

        public function admin_accounts($page_number = 1)
        {
                $this->load->model('admin_model');
                $this->config->load('pagination_options', TRUE);
                $config = $this->config->item('pagination_options');
                $config['base_url'] = site_url('admin/administration/admin_accounts/');
                $config['total_rows'] = $this->admin_model->get_users_count();
                $config['per_page'] = 20;
                $config['uri_segment'] = 4;
                $this->load->library('pagination', $config);
                $limit = $config['per_page'];
                $offset = $limit * ($page_number - 1);
                $data['administrators'] = $this->admin_model->get_users(abs($limit), abs($offset));
                $this->template->set('title', 'Admin Accounts');
                $this->template->load('templates/admin/brainlight', 'admin/admin_accounts', $data);
        }

        /**
         * Logs out the current user, redirect to login url
         * 
         * 
         */
        public function logout()
        {
                $this->admin_auth->logout();
                redirect(site_url('admin/administration/login'));
        }

        public function new_account()
        {
                // Lets define both success and error to false
                $data['errors'] = FALSE;
                $data['success'] = FALSE;
                $this->load->library('form_validation');
                //load validation rules
                $this->config->load('admin_forms_validations');
                $rules = $this->config->item('admin_new_account', 'admin_forms_validations');
                $this->form_validation->set_rules($rules);
                if (!$this->input->post('create') OR ($this->form_validation->run() === FALSE))
                {
                        if ($this->input->post('create'))
                        {
                                $data['errors'][] = validation_errors();
                        }
                }
                else
                {
                        $this->load->model('admin_model');
                        $post = $this->input->post();
                        $additional_data = array(
                            'position' => $post['position']
                        );

                        // This method should work quite well.
                        if ($this->admin_model->register($post['email'], $post['password'], $post['email'], $post['title'], $post['first_name'], $post['last_name'], $additional_data, 'admin'))
                        {
                                $success = "A new administrator successfully added to the system.";
                                $data['success'] = $success;
                        }
                        else
                        {
                                $errors[] = $this->admin_model->errors();
                                $data['errors'] = $errors;
                        }
                }
                $this->template->set('title', 'New Admin Account Setup');
                $this->template->load('templates/admin/brainlight', 'admin/new_account', $data);
        }

        public function edit_account($admin_id = FALSE)
        {
                if (!$admin_id)
                        show_404();
                $data['success'] = FALSE;
                $data['errors'] = FALSE;

                if ($this->input->post())
                {
                        $user_id = $this->input->post('admin_id');
                        $update_data['title'] = $this->input->post('title');
                        $update_data['first_name'] = $this->input->post('first_name');
                        $update_data['last_name'] = $this->input->post('last_name');
                        $update_data['email'] = $this->input->post('email');
                        $update_data['active'] = $this->input->post('status');
                        $update_data['position'] = $this->input->post('position');
                        if ($this->admin_auth->update_user($user_id, $update_data))
                        {
                                $data['success'] = TRUE;
                        }
                        else
                        {
                                $data['errors'][] = "We have some errors here! Did you change e-mail?";
                        }
                }
                if ($data['admin'] = $this->admin_auth->get_user($admin_id))
                {
                        $this->template->set('title', 'Modify Administrator Account');
                        $this->template->load('templates/admin/brainlight', 'admin/edit_account', $data);
                }
                else
                {
                        show_404();
                }
        }

}