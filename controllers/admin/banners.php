<?php
 /**
   @rudra shrestha - rusagar.com
 */

defined('BASEPATH') or die('No direct Script Access');
require_once APPPATH . 'libraries/Admin_controller.php';

class Banners extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->restricted_pages = array('index', 'form');
		$this->load->model('banner_model');
		$this->load->helper('date');
        $this->lang->load('banner');
	}
		
	function index()
	{
		$data['banners'] = $this->banner_model->get_banners();
		$this->template->set('title', 'Banners');
		$this->template->load('templates/admin/brainlight', 'admin/banners/index', $data);	
	}
	/********************************************************************
	this function is called by an ajax script, it re-sorts the banners
	********************************************************************/
        
	function organize()
	{
		$banners = $this->input->post('banners');
		$this->banner_model->organize($banners);
	}
	
	function delete($id)
	{
		$this->banner_model->delete($id);
		
		$this->session->set_flashdata('message', lang('message_delete_banner'));
		redirect('admin/banners');
	}
	
	function form($id = false)
	{
		
		$config['upload_path']		= 'uploads';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']		= intval(ini_get('upload_max_filesize'))*1024; //$this->config->item('size_limit');
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data	= array('id'=>$id
                                    ,'title'=>''
                                    ,'enable_on'=>''
                                    ,'disable_on'=>''
                                    ,'image'=>''
                                    ,'link'=>''
                                    ,'new_window'=>false	
                            );

		if($id)
		{
			$data                   = (array) $this->banner_model->get_banner($id);
			$data['enable_on']	= format_mdy($data['enable_on']);
			$data['disable_on']	= format_mdy($data['disable_on']);
			$data['new_window']	= (bool) $data['new_window'];
		}
		
		//$data['page_title']	= lang('banner_form');
                $this->template->set('title', 'Banners');
		
		$this->form_validation->set_rules('title', 'Title', 'trim|required|full_decode');
		$this->form_validation->set_rules('enable_on', 'Enable', 'trim');
		$this->form_validation->set_rules('disable_on', 'Disable', 'trim|callback_date_check');
		$this->form_validation->set_rules('image', 'Image', 'trim');
		$this->form_validation->set_rules('link', 'Link', 'trim');
		$this->form_validation->set_rules('new_window', 'Window', 'trim');
		
		if ($this->form_validation->run() == false)
		{
			$data['errors'][] = validation_errors();
            $this->template->load('templates/admin/brainlight', 'admin/banners/banner_form', $data);	
		}
		else
		{	
			
			$uploaded	= $this->upload->do_upload('image');
			
			$save['title']			= $this->input->post('title');
			$save['enable_on']		= format_ymd($this->input->post('enable_on'));
			$save['disable_on']		= format_ymd($this->input->post('disable_on'));
			$save['link']			= $this->input->post('link');
			$save['new_window']		= $this->input->post('new_window');
			
			if ($id)
			{
				$save['id']	= $id;
				
				//delete the original file if another is uploaded
				if($uploaded)
				{
					if($data['image'] != '')
					{
						$file = 'uploads/'.$data['image'];
						
						//delete the existing file if needed
						if(file_exists($file))
						{
							unlink($file);
						}
					}
				}
				
			}
			else
			{
				if(!$uploaded)
				{
					$data['error']	= $this->upload->display_errors();
					$this->template->load('templates/admin/brainlight', 'admin/banner_form', $data);
					return; //end script here if there is an error
				}
			}
			
			if($uploaded)
			{
				$image	= $this->upload->data();
				$save['image']	= $image['file_name'];
			}
			
			$this->banner_model->save_banner($save);
			
			$this->session->set_flashdata('message', lang('message_banner_saved'));
			
			redirect('admin/banners');
		}	
	}

	function date_check()
	{
		
		if ($this->input->post('disable_on') != '')
		{
			if (format_ymd($this->input->post('disable_on')) <= format_ymd($this->input->post('enable_on')))
			{
				$this->form_validation->set_message('date_check', lang('date_error'));
				return FALSE;
			}
		}
		
		return TRUE;
	}
}