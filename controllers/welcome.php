<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
        public $auth;
        
         public function __construct() {
         
             parent::__construct();
             session_start();
             session_regenerate_id();
             $this->load->helper('cookie');
             if(get_cookie('user_type'))
             {
                     $user_type = get_cookie('user_type');
                     switch ($user_type)
                     {
                             case 'recruiter':
                                     redirect(recruiter_dashboard_url());
                                     break;
                             case 'seeker':
                                     redirect(site_url('my-elaw-seek'));
                                     break;

                             default:
                                     break;
                     }
             }
             $this->load->model('seeker/alert_model','alert_model');
             $this->load->model('country_state_model','country_model');
             $this->load->model('search_model');
             $this->load->model('page_model');
             
             
         }
         
         /**
          * Function for public search
          */
         
	public function index()
	{
            if (!$this->session->userdata('is_first')) {
                $countryDetail = (unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$this->input->ip_address())));
                $is_country = $this->country_model->get_countries_by_name($countryDetail['geoplugin_countryName']);
                if ($is_country) {
                    $this->session->set_userdata('c_id', $is_country->id);
                    $this->session->set_userdata('c_name', $is_country->name);
                } else {
                    $is_country = $this->country_model->get_countries_by_name('Australia');
                    $this->session->set_userdata('c_id', $is_country->id);
                    $this->session->set_userdata('c_name', $is_country->name);
                }

                $this->session->set_userdata('loc_name', 'All');
                $this->session->set_userdata('change_country', 'yes');
                $this->session->set_userdata('is_first', TRUE);
            }
            $job_type_id ="";
            
            $practice_area_id = "";
            
            $locations_id = "";
            
            $data['job_type'] = $this->search_model->get_job_type();
            header("Expires: Sat, 31 Jan 2099 00:00:00 GMT");
            foreach($data['job_type'] as $job){
                $job_type_id .= $job->id.",";
            }
            $data['job_type_id'] = $job_type_id;
            
            $data['practice_area'] = $this->search_model->get_practice_area();
            
            foreach($data['practice_area'] as $practice){
                $practice_area_id .= $practice->id.",";
            }
            $data['practice_area_id'] = $practice_area_id;
            $data['work_types'] = $this->alert_model->getWorkTypes();

if ($this->session->userdata('c_id'))
    $country_id = $this->session->userdata('c_id');
else 
    $country_id = 'all';
            
            $data['locations_info'] = $this->search_model->get_locations($country_id);
            
            foreach($data['locations_info'] as $locations){
                $locations_id .= $locations->id.",";
            }
            
            $data['locations_id'] = rtrim($locations_id,',');
            $meta = $this->config->item('meta');
            $data['meta'] = $meta['public'];
            
			$page_title=$this->config->item('home_page_title');
            $this->template->set('title',$page_title);
            $this->template->load('templates/public/public_default', 'my_elaw_public/search',$data);
            
	}
        /**
         * Function for Public site pages
         */
        public function pages($permalink)
        {
            $locations_id ="";
            $data['page_info'] = $this->page_model->get_page_by_permalink($permalink);
                if ($this->session->userdata('c_id'))
                $country_id = $this->session->userdata('c_id');
                else 
                $country_id = 'all';               
            $data['locations_info'] = $this->search_model->get_locations($country_id);
            
            foreach($data['locations_info'] as $locations){
                $locations_id .= $locations->id.",";
            }
            
            $data['perm'] = $permalink;
            
            $data['locations_id'] = rtrim($locations_id,',');
            
            $meta = $this->config->item('meta');
            $data['meta'] = $meta[$permalink];
            
            $this->template->set('title','Welcome Bizelaw : Search Jobs');
            $this->template->load('templates/public/public_default', 'my_elaw_public/pages',$data);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */