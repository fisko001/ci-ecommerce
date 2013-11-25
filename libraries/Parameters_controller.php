<?php

defined('BASEPATH') or die('No direct Script Access');
require_once 'Admin_controller.php';

class Parameters_controller extends Admin_Controller
{

        public $parameter_name;

        public function __construct()
        {
                parent::__construct();
                $this->load->model('parameters_model');
                $this->load->helper('form');
                $this->restricted_pages = array('index', 'edit', 'add');
        }

        public function index()
        {
                $parameters = $this->parameters_model->all(TRUE);
                if (!$parameters)
                {
                        $parameters = array();
                }
                {
                        $this->template->set('title', $this->parameter_name);
                        $this->template->load('templates/admin/brainlight', 'parameters/list', array('parameters' => $parameters));
                }
        }

        /**
         * Edits the current parameter, change name value or publish/unpublish
         * 
         * @param type $id Id of the current parameter
         */
        public function edit($id)
        {
                if (!$this->input->post('edit'))
                {
                        if (!isset($id))
                                show_404();
                        $data['parameter'] = $this->parameters_model->get($id);
                        if (!$data['parameter'])
                                show_404();
                        $this->template->set('title', 'Edit ' . $this->parameter_name);
                        $this->template->load('templates/admin/brainlight', 'parameters/edit', $data);
                }
                else
                {
                        if (!$this->input->post('name')
                                OR $this->parameters_model->parameter_check($this->input->post('name'), $this->input->post('id')))
                        {
                                echo "Edit Failed, not set or already exists";
                        }
                        else
                        {
                                //edit the name to database
                                echo $this->parameters_model->update($id, $this->input->post('name'), (bool) $this->input->post('status'), $this->input->post('order')) ? 'Successfully Edited' : 'Nothing to edit!';
                        }
                }
        }

        public function add()
        {
                $this->template->set('title','Add new '.$this->parameter_name);
                if (!$this->input->post('submit'))
                {
                        $this->template->load('templates/admin/brainlight','parameters/add');
                }
                else
                {
                        if (!$this->input->post('name')
                                OR $this->parameters_model->parameter_check($this->input->post('name')))
                        {
                                echo "Cannot add, not set or already exists";
                        }
                        else
                        {
                                //add the name to database
                                echo $this->parameters_model->add($this->input->post('name'), (bool) $this->input->post('status'), $this->input->post('order')) ? 'Successfully Posted' : 'An error Occured!';
                        }
                }
        }

}