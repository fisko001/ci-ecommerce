<?php
 /**
   @rudra shrestha - rusagar.com
 */

defined('BASEPATH') or die('No direct Script Access');
require_once APPPATH . 'libraries/Admin_controller.php';

class Tickets extends Admin_Controller {

	//this is used when editing or adding a customer
	var $support_ticket_id	= false;	

	function __construct()
	{		
		parent::__construct();
		$this->restricted_pages = array('index', 'form');
		$this->load->model('ticket_model');
		$this->lang->load('customer');
	}
	
	function index( $code = 0, $category_id=0,  $field='date_opened', $by='DESC', $page=0)
	{
		//we're going to use flash data and redirect() after form submissions to stop people from refreshing and duplicating submissions
		
		$this->template->set('title', 'Support Tickets');
		
		$data['code']       = $code;
		$term               = false;
		$support_ticket_category_id = false;
		
		
		
		$post = $this->input->post(null, false);
                
		$this->load->model('search_model');
		if($post)
		{
			$term       = json_encode($post);
			$code       = $this->search_model->record_term($term);
			$data['code']  = $code;
		}
		elseif ($code)
		{
			$term       = $this->search_model->get_term($code);
		}
		
		$data['tickets']    = $this->ticket_model->get_supporttickets(array('term'=>$term),$category_id, 20, $page, $field, $by);
		
		// get categories list on the form of search form - header
		$categories = $this->ticket_model->get_ticketscategory();
		$data['category_list'] = $categories;
		
		$this->load->library('pagination');

		$config['base_url']			= base_url().'/'.'admin/tickets/index/'.$field.'/'.$by.'/';
		$config['total_rows']       = $this->ticket_model->count_supporttickets();
		$config['per_page']			= 20;
		$config['uri_segment']      = 6;
		$config['first_link']		= 'First';
		$config['first_tag_open']	= '<li>';
		$config['first_tag_close']	= '</li>';
		$config['last_link']		= 'Last';
		$config['last_tag_open']	= '<li>';
		$config['last_tag_close']	= '</li>';

		$config['full_tag_open']	= '<div class="pagination"><ul>';
		$config['full_tag_close']	= '</ul></div>';
		$config['cur_tag_open']		= '<li class="active"><a href="#">';
		$config['cur_tag_close']	= '</a></li>';
		
		$config['num_tag_open']		= '<li>';
		$config['num_tag_close']	= '</li>';
		
		$config['prev_link']		= '&laquo;';
		$config['prev_tag_open']	= '<li>';
		$config['prev_tag_close']	= '</li>';

		$config['next_link']		= '&raquo;';
		$config['next_tag_open']	= '<li>';
		$config['next_tag_close']	= '</li>';
		
		$this->pagination->initialize($config);		
		
		$data['page']	= $page;
		$data['field']	= $field;
		$data['by']	= $by;		
		
       	$this->template->load('templates/admin/brainlight', 'admin/tickets/index', $data);	
	}
	
	function form($support_ticket_id = false)
	{
		$this->load->helper('form');
		$this->load->helper('date_helper');
		$this->load->library('form_validation');
		
		$this->template->set('title', "Support Tickets");
		
		// Get topics lists discussion from this topic - List and the form to Update the Topic.
		$data['topics']= $this->ticket_model->get_supportticket_topics($support_ticket_id);
		
		// Get categories list on the view topic page of Tickets
		$categories = $this->ticket_model->get_ticketscategory();
		$data['category_list'] = $categories;
		
		
		$this->form_validation->set_rules('message', 'reply', 'trim|required');
		$this->form_validation->set_rules('close', 'close');
		
		if ($this->form_validation->run() == FALSE)
		{
                $this->template->load('templates/admin/brainlight', 'admin/tickets/ticket_form', $data);
		}
		else //insert new reply to the entry
		{
	
			$save['item']				= $this->input->post('message');
			$save['added_on']			= now_time();
			$save['support_ticket_id']	= $support_ticket_id;
			$save['support']			= 1;
			
			
			if($this->input->post('close') == "1"){
				$save_ticket['date_closed']	= now_time();	
			}
			$save_ticket['priority'] = $this->input->post('priority');	
			
			$this->ticket_model->save_ticket($save,$save_ticket);	
			
			$this->session->set_flashdata('message', 'Your reply to the discussion posted successfully.');			
			// go back to the customer list
			redirect('admin/tickets/form/'.$support_ticket_id);

		}		
		
	}
	

	function delete($id = false)
	{
		if ($id)
		{	
			$ticket	= $this->ticket_model->get_supportticket($id);
			// if the product does not exist, redirect them to the customer list with an error
			if (!$ticket)
			{
				$this->session->set_flashdata('error','The requested product could not be found');
				redirect('admin/tickets');
			}
			else
			{
				// if the ticket is legit, delete them
				$this->ticket_model->delete_ticket($id);

				$this->session->set_flashdata('message', 'The product has been deleted.');
				redirect('admin/tickets');
			}
		}
		else
		{
			// if they do not provide an id send them to the product list page with an error
			$this->session->set_flashdata('error','The requested product could not be found');
			redirect('admin/tickets');
		}
	}
	
	
}