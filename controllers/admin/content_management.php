<?php
 /**
   @rudra shrestha - rusagar.oom
 */

defined('BASEPATH') or die('No direct Script Access');
require_once APPPATH . 'libraries/Admin_controller.php';

class Content_management extends Admin_controller
{

        public function __construct()
        {
                parent::__construct();
                $this->restricted_pages = array('add_pages', 'add_pages', 'edit', 'add_cms_pages',
                'edit_cms_pages', 'delete', 'index');
                $this->load->model('content_model');
                $this->load->library('form_validation');
        }
        
        /**
         *Function Index 
         */
        public function index()
        {
            $data['content_pages'] = $this->content_model->getContentData();
            $this->template->set('title', 'Content Management');
            $this->template->load('templates/admin/brainlight', 'admin/content/index',$data);
        }
        /**
         * Add new Content Pages
         */
        
        public function add_pages()
        {
                $data['success'] = "";
                $data['errors'] = "";
                $this->template->set('title', 'Add New page');
                $this->template->load('templates/admin/brainlight', 'admin/content/add_page',$data);
        }
        /**
         *Add Content pages 
         */
        public function add_cms_pages()
        {
            $this->form_validation->set_rules('page_name','Page Name','required');
            $this->form_validation->set_rules('permalink','Permalink','required');
            if($this->form_validation->run()==false){
                $data['success'] = "";
                $data['errors'] = "";
                $this->template->set('title', 'Add New page');
                $this->template->load('templates/admin/brainlight', 'admin/content/add_page',$data);
            }
            else{
             $this->content_model->add_new_page();
             $data['success'] = "Cms Page created successfully.";
             redirect('admin/content_management');
            }
        }
        /**
         *Function for cms page edit 
         */
        public function edit($id)
        {
            $data['edit_id'] = $id;
            $data['success'] = "";
            $data['errors'] = "";
            $data['page_info'] = $this->content_model->getPagesById($id);
            $this->template->set('title', 'Edit Page');
            $this->template->load('templates/admin/brainlight', 'admin/content/edit_page',$data);
        }
        /**
         * Function for the update the pages
         */
        public function edit_cms_pages($id)
        {
            $this->form_validation->set_rules('page_name','Page Name','required');
            $this->form_validation->set_rules('permalink','Permalink','required');
            if($this->form_validation->run()==false){
                $data['success'] = "";
                $data['errors'] = "";
                $data['page_info'] = $this->content_model->getPagesById($id);
                $this->template->set('title', 'Add New page');
                $this->template->load('templates/admin/brainlight', 'admin/content/add_page',$data);
            }
            else{
             $this->content_model->update_page($id);
             $data['success'] = "Cms Page Updated successfully.";
             redirect('admin/content_management');
            }
        }
        
        /**
         *Function for the delete pages 
         */
        public function delete($id)
        {
            $this->db->where('id',$id);
            $this->db->delete('cms_pages');
            $this->session->set_flashdata('message','Page Deleted Successfully');
            redirect('admin/content_management');
        }
}
