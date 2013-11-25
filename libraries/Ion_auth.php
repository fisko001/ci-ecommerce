<?php

if (!defined('BASEPATH'))
        exit('No direct script access allowed');

/**
 * Name:  Ion Auth
 *
 * Author: Ben Edmunds
 * 		  ben.edmunds@gmail.com
 *         @benedmunds
 *
 * Added Awesomeness: Phil Sturgeon
 *
 * Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
 *
 * Created:  10.01.2009
 *
 * Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
 * Original Author name has been kept but that does not mean that the method has not been modified.
 *
 * Requirements: PHP5 or above
 *
 */
class Ion_auth
{

        /**
         * CodeIgniter global
         *
         * @var string
         * */
        protected $ci;

        /**
         * account status ('not_activated', etc ...)
         *
         * @var string
         * */
        protected $status;

        /**
         * message (uses lang file)
         *
         * @var string
         * */
        protected $messages;

        /**
         * error message (uses lang file)
         *
         * @var string
         * */
        protected $errors = array();

        /**
         * extra where
         *
         * @var array
         * */
        public $_extra_where = array('user_type' => 'admin');

        /**
         * Meta extra where
         *
         * @var array
         */
        public $_meta_extra_where = array();

        /**
         * extra set
         *
         * @var array
         * */
        public $_extra_set = array();

        /**
         * Holds user type to check user type
         * 
         * @var type 
         * @author Nitesh
         */
        public $user_type;

        /**
         * __construct
         *
         * @return void
         * @author Mathew
         * */
        public function __construct()
        {
                $this->ci = & get_instance();
                $this->ci->load->config('ion_auth', TRUE);
                $this->ci->load->library('email');
                $this->ci->load->library('session');
                $this->ci->lang->load('ion_auth');
                $this->ci->load->model('password_requested_model');
                $this->ci->load->helper('cookie');

                $this->messages = array();
                $this->errors = array();

                //auto-login the user if they are remembered
        }

        /**
         * __call
         *
         * Acts as a simple way to call model methods without loads of stupid alias'
         *
         * */
        public function __call($method, $arguments)
        {
                if (!method_exists($this->ci->ion_auth_model, $method))
                {
                        throw new Exception('Undefined method Ion_auth::' . $method . '() called');
                }

                return call_user_func_array(array($this->ci->ion_auth_model, $method), $arguments);
        }

        /**
         * Activate user.
         *
         * @return void
         * @author Mathew
         * */
        public function activate($id, $code=false)
        {
                if ($this->ci->ion_auth_model->activate($id, $code))
                {
                        $this->set_message('activate_successful');
                        return TRUE;
                }

                $this->set_error('activate_unsuccessful');
                return FALSE;
        }

        /**
         * Deactivate user.
         *
         * @return void
         * @author Mathew
         * */
        public function deactivate($id)
        {
                if ($this->ci->ion_auth_model->deactivate($id))
                {
                        $this->set_message('deactivate_successful');
                        return TRUE;
                }

                $this->set_error('deactivate_unsuccessful');
                return FALSE;
        }

        /**
         * Change password.
         *
         * @return void
         * @author Mathew
         * */
        public function change_password($identity, $old, $new)
        {
                if ($this->ci->ion_auth_model->change_password($identity, $old, $new))
                {
                        $this->set_message('password_change_successful');
                        return TRUE;
                }

                $this->set_error('password_change_unsuccessful');
                return FALSE;
        }

        /**
         * forgotten password feature
         *
         * @return void
         * @author Mathew
         * */
        public function forgotten_password($identity)    //changed $email to $identity
        {
                // Get user information
                //get the details of the user, and thus his email address **before** sending a request to the model
                
                $user = $this->get_user_by_identity($identity);
                
                if(count($user)>0){
                    
                $email = $user->email;
                
                }else{
                    
                    $this->set_message('forgot_password_unsuccessful');
                    return FALSE;
                }

                if ($this->ci->ion_auth_model->forgotten_password($email))   //changed
                {
                     //   echo "<pre>";
                        //we are doing this again to get the correct password reset request code
                        //$user = $this->get_user_by_identity($identity);
                        $data = array(
                            'identity' => $user->{$this->ci->config->item('identity', 'ion_auth')},
                            'forgotten_password_code' => $this->ci->ion_auth_model->forgotten_password_code,
                        );
                        $this->forgotten_password_complete($data['forgotten_password_code']);    
                        /*$message = $this->ci->load->view($this->ci->config->item('email_templates', 'ion_auth') . $this->ci->config->item('email_forgot_password', 'ion_auth'), $data, true);
                        
                        $this->ci->email->clear();
                        $config['mailtype'] = $this->ci->config->item('email_type', 'ion_auth');
                        
                        $this->ci->email->initialize($config);
                        $this->ci->email->set_newline("\r\n");
                        $this->ci->email->from($this->ci->config->item('admin_email', 'ion_auth'), $this->ci->config->item('site_title', 'ion_auth'));
                        $this->ci->email->to($user->email);
                        $this->ci->email->subject($this->ci->config->item('site_title', 'ion_auth') . ' - Forgotten Password Verification');
                        $this->ci->email->message($message);
                        
                        if ($this->ci->email->send())
                        {
                            
                                $this->set_message('forgot_password_successful');
                                return TRUE;
                        }
                        else
                        {
                            
                                $this->set_error('forgot_password_unsuccessful');
                                return FALSE;
                        }*/
                }
                else
                {
                    
                        $this->set_error('forgot_password_unsuccessful');
                        return FALSE;
                }
        }

        /**
         * forgotten_password_complete
         *
         * @return void
         * @author Mathew
         * */
        public function forgotten_password_complete($code)
        {
                $identity = $this->ci->config->item('identity', 'ion_auth');
                $profile = $this->ci->ion_auth_model->profile($code, true); //pass the code to profile

                if (!is_object($profile))
                {
                        $this->set_error('password_change_unsuccessful');
                        return FALSE;
                }

                $new_password = $this->ci->ion_auth_model->forgotten_password_complete($code, $profile->salt);

                if ($new_password)
                {
                        $data = array(
                            'identity' => $profile->{$identity},
                            'new_password' => $new_password
                        );

                        $message = $this->ci->load->view($this->ci->config->item('email_templates', 'ion_auth') . $this->ci->config->item('email_forgot_password', 'ion_auth'), $data, true);

                        $this->ci->email->clear();
                        $this->config->load('bizelaw_emails', TRUE);
                        $config['mailtype'] = $this->ci->config->item('email_type', 'ion_auth');
                        $this->ci->email->initialize($config);
                        $this->ci->email->set_newline("\r\n");
                        $this->ci->email->from($this->ci->config->item('admin_email', 'ion_auth'), $this->ci->config->item('site_title', 'ion_auth'));
                        $this->ci->email->to($profile->email);
                        $this->ci->email->subject($this->ci->config->item('site_title', 'ion_auth') . ' - Forgotten Password Verification');
                        $this->ci->email->message($message);

                        if ($this->ci->email->send())
                        {
                                $this->set_message('password_change_successful');
                                $this->ci->password_requested_model->insert_info($profile->{$identity});
                                return TRUE;
                        }
                        else
                        {
                                $this->set_error('password_change_unsuccessful');
                                return FALSE;
                        }
                }

                $this->set_error('password_change_unsuccessful');
                return FALSE;
        }

        /**
         * register
         *
         * @return void
         * @author Mathew
         * */
        public function register($username, $password, $email, $title, $first_name, $last_name, $additional_data, $group_name = false) //need to test email activation
        {
                $email_activation = $this->ci->config->item('email_activation', 'ion_auth');
                $id = $this->ci->ion_auth_model->register($username, $password, $email, $title, $first_name, $last_name, $additional_data, $group_name);
                if ($id !== FALSE)
                {
                        $this->set_message('account_creation_successful');
                        return $id;
                }
                else
                {
                        $this->set_error('account_creation_unsuccessful');
                        return FALSE;
                }
        }

        /**
         * login
         *
         * @return void
         * @author Mathew
         * */
        public function login($identity, $password, $remember=false)
        {
                if ($this->ci->ion_auth_model->login($identity, $password, $remember))
                {
                        $this->set_message('login_successful');
                        return TRUE;
                }

                $this->set_error('login_unsuccessful');
                return FALSE;
        }

        /**
         * logout
         *
         * @return void
         * @author Mathew
         * */
        public function logout()
        {
                $identity = $this->ci->config->item('identity', 'ion_auth');
                $this->ci->session->unset_userdata($identity);
                $this->ci->session->unset_userdata('group');
                $this->ci->session->unset_userdata('id');
                $this->ci->session->unset_userdata('user_id');

//delete the remember me cookies if they exist
                if (get_cookie('identity'))
                {
                        delete_cookie('identity');
                }
                if (get_cookie('remember_code'))
                {
                        delete_cookie('remember_code');
                }
                if (get_cookie('user_type'))
                {
                        delete_cookie('user_type');
                }

                $this->ci->session->sess_destroy();

                $this->set_message('logout_successful');
// Added by Nitesh!
                session_destroy();
                return TRUE;
        }

        /**
         * logged_in
         *
         * @return bool
         * @author Mathew
         * */
        public function logged_in()
        {
                $identity = $this->ci->config->item('identity', 'ion_auth');
                if (!isset($_SESSION))
                        session_start();
// changes to check if the set user_type is correct
                return isset($_SESSION['user_id']) && $_SESSION['user_type'] == $this->user_type;
        }

        /**
         * is_group
         *
         * @return bool
         * @author Phil Sturgeon
         * */
        public function is_group($check_group)
        {
                $user_group = $this->ci->session->userdata('group');

                if (is_array($check_group))
                {
                        return in_array($user_group, $check_group);
                }

                return $user_group == $check_group;
        }

        /**
         * Profile
         *
         * @return void
         * @author Mathew
         * */
        public function profile()
        {
                $session = $this->ci->config->item('identity', 'ion_auth');
                $identity = $this->ci->session->userdata($session);

                return $this->ci->ion_auth_model->profile($identity);
        }

        /**
         * Get Users
         *
         * @return object Users
         * @author Ben Edmunds
         * */
        public function get_users($group_name=false, $limit=NULL, $offset=NULL)
        {
                return $this->ci->ion_auth_model->get_users($group_name, $limit, $offset);
        }

        /**
         * Get Number of Users
         *
         * @return int Number of Users
         * @author Sven Lueckenbach
         * */
        public function get_users_count($group_name=false)
        {
                return $this->ci->ion_auth_model->get_users_count($group_name);
        }

        /**
         * Get Users Array
         *
         * @return array Users
         * @author Ben Edmunds
         * */
        public function get_users_array($group_name=false, $limit=NULL, $offset=NULL)
        {
                return $this->ci->ion_auth_model->get_users($group_name, $limit, $offset)->result_array();
        }

        /**
         * Get Newest Users
         *
         * @return object Users
         * @author Ben Edmunds
         * */
        public function get_newest_users($limit = 10)
        {
                return $this->ci->ion_auth_model->get_newest_users($limit)->result();
        }

        /**
         * Get Newest Users Array
         *
         * @return object Users
         * @author Ben Edmunds
         * */
        public function get_newest_users_array($limit = 10)
        {
                return $this->ci->ion_auth_model->get_newest_users($limit)->result_array();
        }

        /**
         * Get Active Users
         *
         * @return object Users
         * @author Ben Edmunds
         * */
        public function get_active_users($group_name = false)
        {
                return $this->ci->ion_auth_model->get_active_users($group_name)->result();
        }

        /**
         * Get Active Users Array
         *
         * @return object Users
         * @author Ben Edmunds
         * */
        public function get_active_users_array($group_name = false)
        {
                return $this->ci->ion_auth_model->get_active_users($group_name)->result_array();
        }

        /**
         * Get In-Active Users
         *
         * @return object Users
         * @author Ben Edmunds
         * */
        public function get_inactive_users($group_name = false)
        {
                return $this->ci->ion_auth_model->get_inactive_users($group_name)->result();
        }

        /**
         * Get In-Active Users Array
         *
         * @return object Users
         * @author Ben Edmunds
         * */
        public function get_inactive_users_array($group_name = false)
        {
                return $this->ci->ion_auth_model->get_inactive_users($group_name)->result_array();
        }

        /**
         * Get User
         *
         * @return object User
         * @author Ben Edmunds
         * */
        public function get_user($id=false)
        {
                return $this->ci->ion_auth_model->get_user($id);
        }

        /**
         * Get User by Email
         *
         * @return object User
         * @author Ben Edmunds
         * */
        public function get_user_by_email($email)
        {
                return $this->ci->ion_auth_model->get_user_by_email($email)->row();
        }

        /**
         * Get Users by Email
         *
         * @return object Users
         * @author Ben Edmunds
         * */
        public function get_users_by_email($email)
        {
                return $this->ci->ion_auth_model->get_users_by_email($email)->result();
        }

        /**
         * Get User by Username
         *
         * @return object User
         * @author Kevin Smith
         * */
        public function get_user_by_username($username)
        {
                return $this->ci->ion_auth_model->get_user_by_username($username)->row();
        }

        /**
         * Get Users by Username
         *
         * @return object Users
         * @author Kevin Smith
         * */
        public function get_users_by_username($username)
        {
                return $this->ci->ion_auth_model->get_users_by_username($username)->result();
        }

        /**
         * Get User by Identity
         *                              //copied from above ^
         * @return object User
         * @author jondavidjohn
         * */
        public function get_user_by_identity($identity)
        {
            //echo "<pre>"; print_r($this->ci->ion_auth_model->get_user_by_identity($identity)); exit;
                return $this->ci->ion_auth_model->get_user_by_identity($identity);
        }

        /**
         * Get User as Array
         *
         * @return array User
         * @author Ben Edmunds
         * */
        public function get_user_array($id=false)
        {
                return $this->ci->ion_auth_model->get_user($id)->row_array();
        }

        /**
         * update_user
         *
         * @return void
         * @author Phil Sturgeon
         * */
        public function update_user($id, $data)
        {
                if ($this->ci->ion_auth_model->update_user($id, $data))
                {
                        $this->set_message('update_successful');
                        return TRUE;
                }

                $this->set_error('update_unsuccessful');
                return FALSE;
        }

        /**
         * delete_user
         *
         * @return void
         * @author Phil Sturgeon
         * */
        public function delete_user($id)
        {
                if ($this->ci->ion_auth_model->delete_user($id))
                {
                        $this->set_message('delete_successful');
                        return TRUE;
                }

                $this->set_error('delete_unsuccessful');
                return FALSE;
        }

        /**
         * Addtion of Magic Methods
         * 
         * @author Nitesh <nitesh@nitesh.com.np>
         */
        public function __get($name)
        {
                return $this->ci->ion_auth_model->$name;
        }

        public function __set($name, $value)
        {
                $this->ci->ion_auth_model->$name = $value;
        }

}