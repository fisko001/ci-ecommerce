<?php
 /**
   @rudra shrestha - rusagar.oom
 */

defined('BASEPATH') or die('No direct Script Access');
require_once APPPATH . 'libraries/Admin_controller.php';

class Emails_management extends Admin_controller{
        public function __construct(){
                parent::__construct();
                $this->restricted_pages = array('add_emails', 'edit', 'edit_emails', 'delete', 'index');
                $this->load->model('emails_model');
                $this->load->library('form_validation');
        }
        
        /**
         *Function Index 
         */
        public function index(){
            $data['email_pages'] = $this->emails_model->getEmailContentData();
            $this->template->set('title', 'Email Content Management');
            $this->template->load('templates/admin/brainlight', 'admin/emails/index',$data);
        }
		/**
         * Add new Email Content
         */        
        public function add_emails(){
                $data['success'] = "";
                $data['errors'] = "";
                $this->template->set('title', 'Add New Email Content');
                $this->template->load('templates/admin/brainlight', 'admin/emails/add_emails',$data);
        }
		
		/**
         *Add Email contents  - Process page
        */
        public function add_email_content(){
            $this->form_validation->set_rules('subject','Subject','required');
            $this->form_validation->set_rules('message','Message','required');
            if($this->form_validation->run()==false){
                $data['success'] = "";
                $data['errors'] = "";
                $this->template->set('title', 'Add New Email Content');
                $this->template->load('templates/admin/brainlight', 'admin/emails/add_emails',$data);
            }
            else{
             $this->emails_model->add_new_email();
             $data['success'] = "Email content created successfully.";
             redirect('admin/emails_management');
            }
        }
		
		/**
         *Function for email content edit 
        */
        public function edit($id){
            $data['email_id'] = $id;
            $data['success'] = "";
            $data['errors'] = "";
            $data['email_info'] = $this->emails_model->getEmailById($id);
            $this->template->set('title', 'Edit Email Content');
            $this->template->load('templates/admin/brainlight', 'admin/emails/edit_emails',$data);
        }
		
		/**
         * Function for the update the email content - process page
        */
        public function edit_email_content($id){
            $this->form_validation->set_rules('subject','Subject','required');
            $this->form_validation->set_rules('message','Message','required');
            if($this->form_validation->run()==false){
                $data['success'] = "";
                $data['errors'] = "";
                $data['email_info'] = $this->emails_model->getEmailById($id);
                $this->template->set('title', 'Edit Email Content');
                $this->template->load('templates/admin/brainlight', 'admin/emails/edit_emails',$data);
            }
            else{
             $this->emails_model->update_email($id);
             $data['success'] = "Email content updated successfully.";
             redirect('admin/emails_management');
            }
        }
		
		/**
         *Function for the delete email content
        */
        public function delete($id){
            $this->db->where('email_id',$id);
            $this->db->delete('status_emails');
            $this->session->set_flashdata('message','Email content deleted successfully');
            redirect('admin/emails_management');
        }   
}
