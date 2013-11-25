<?php

defined('BASEPATH') or die('No direct Script Access');

class Pages extends CI_Controller
{
        public $auth;
        public function __construct()
        {
                parent::__construct();
                session_start();
                session_regenerate_id();
                $this->load->model('search_model');
                $this->load->model('page_model');
        }

        /**
         * Function for Public site pages
         */
        public function index($permalink = '')
        {   
			    $locations_id = "";
                $data['page_info'] = $this->page_model->get_page_by_permalink($permalink);
                
            if ($this->session->userdata('c_id'))
                $country_id = $this->session->userdata('c_id');
            else 
                $country_id = 'all';                   
                $data['locations_info'] = $this->search_model->get_locations($country_id);

                foreach ($data['locations_info'] as $locations)
                {
                        $locations_id .= $locations->id . ",";
                }

                $data['locations_id'] = rtrim($locations_id, ',');

                $page_title=$this->config->item('public_title_'.$permalink);
                
                $meta = $this->config->item('meta');
                
                
                if (isset($meta[$permalink]))
                    $data['meta'] = $meta[$permalink];
                else
                    $data['meta'] = $meta['public'];
                
                $this->template->set('title', $page_title);
                $this->template->load('templates/public/public_default', 'my_elaw_public/pages', $data);
        }

}