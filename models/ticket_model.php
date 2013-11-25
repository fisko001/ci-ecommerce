<?php
 /**
   @rudra shrestha - rusagar.com
 */

Class Ticket_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	
	/*
	List of all the Tickets
	*/
	function get_supporttickets($data=array(), $category_id = 0, $limit=0, $offset=0, $order_by='date_opened', $direction='DESC')
	{	
		if(empty($data))
		{
			$this->db
				->select("support_ticket_id,support_ticket.support_type_categories_id,date_closed is null as `status`, priority,username,category,administrator, DATE_FORMAT(date_opened, '%M %d, %Y %H:%i') as date_opened,DATE_FORMAT(date_closed, '%M %d, %Y %H:%i') as date_closed, customers.firstname, customers.lastname, customers.email,support_type_categories.support_type_categories_name", false)
				->from('support_ticket')
				->join('support_ticket_category', 'support_ticket.support_ticket_category_id=support_ticket_category.support_ticket_category_id', 'INNER')
				->join('customers', 'customers.id=support_ticket.username', 'INNER')
				->join('support_type_categories', 'support_type_categories.support_type_categories_id=support_ticket.support_type_categories_id', 'INNER');
				
			if($category_id >0){
				$this->db->where('support_ticket.support_ticket_category_id', $category_id);
			}
		}else{
			$this->db
				->select("support_ticket_id,support_ticket.support_type_categories_id,date_closed is null as `status`, priority,username,category,administrator, DATE_FORMAT(date_opened, '%M %d, %Y %H:%i') as date_opened,DATE_FORMAT(date_closed, '%M %d, %Y %H:%i') as date_closed, customers.firstname, customers.lastname, customers.email,support_type_categories.support_type_categories_name", false)
				->from('support_ticket')
				->join('support_ticket_category', 'support_ticket.support_ticket_category_id=support_ticket_category.support_ticket_category_id', 'INNER')
				->join('customers', 'customers.id=support_ticket.username', 'INNER')
				->join('support_type_categories', 'support_type_categories.support_type_categories_id=support_ticket.support_type_categories_id', 'INNER');
			
				if(!empty($data['term']))
				{
					$search	= json_decode($data['term']);
					
					//if we are searching dig through some basic fields
					if(!empty($search->term))
					{
						/* //One way
						$this->db->like('priority', $search->term);
						$this->db->or_like('firstname', $search->term);
						$this->db->or_like('lastname', $search->term);
						*/
						// next way - to add the bracket. Not possible on way first
						$this->db->where("(priority LIKE '%".$this->db->escape_like_str($search->term)."%' OR firstname LIKE '%".$this->db->escape_like_str($search->term)."%' OR lastname LIKE '%".$this->db->escape_like_str($search->term)."%')", NULL, FALSE);
					}	
					
					if(!empty($search->support_ticket_category_id))
					{				
						$this->db->where('support_ticket.support_ticket_category_id', $search->support_ticket_category_id);
				
					}
					
				}
				// category_id submission on GET variable
				if($category_id >0){
					$this->db->where('support_ticket.support_ticket_category_id', $category_id);
				}	
		}
		
		$this->db->order_by($order_by, $direction);
		
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}
		$result	= $this->db->get()->result();
		//echo $str = $this->db->last_query();			
		return $result;
	}
	
	/*
	Total Count of the Tickets saved in the system
	*/
	function count_supporttickets()
	{
		return $this->db->count_all_results('support_ticket');
	}
	
	/*
	Details of support ticket
	*/
	function get_supportticket($id)
	{
		
		$result	= $this->db->get_where('support_ticket', array('support_ticket_id'=>$id));
		return $result->row();
	}
	
	
	/*
	Details of support ticket item
	*/
	function get_supportticket_item($id)
	{
		
		$result	= $this->db->get_where('support_ticket_item', array('support_ticket_item_id'=>$id));
		return $result->row();
	}
	
	/*
	View page of Ticket - listing of discussion.
	*/
	function get_supportticket_topics($id)
	{
		
		$this->db
				->select("support_ticket.username as username,  administrator, support_ticket.support_ticket_id,priority, support_ticket.support_ticket_category_id,  support_ticket.support_type_categories_id, date_closed is null as `status`,category,DATE_FORMAT(date_opened, '%M %d, %Y %H:%i') as date_opened, DATE_FORMAT(added_on, '%M %d, %Y %H:%i') as added_on, item, support, customers.firstname, customers.lastname, support_ticket_item.user_id, support_ticket_item.backend_reply, support_ticket_item.support_ticket_item_id ", false)
				->from('support_ticket')
				->join('support_ticket_item', 'support_ticket.support_ticket_id=support_ticket_item.support_ticket_id', 'LEFT')
				->join('support_ticket_category', 'support_ticket.support_ticket_category_id=support_ticket_category.support_ticket_category_id', 'INNER')
				->join('customers', 'customers.id=support_ticket.username', 'INNER')
				->join('support_type_categories', 'support_type_categories.support_type_categories_id=support_ticket.support_type_categories_id', 'INNER')
				->where('support_ticket.support_ticket_id', $id);
				$this->db->order_by("support_ticket_item_id", "DESC");
				
		$result	= $this->db->get()->result();			
		return $result;
	}
	
	/*
	Saving topic reply to the Ticket
	*/
	function save_ticket($topic,$topic_ticket)
	{
			//update also the priority / close status of the ticket if someone change it 
			$this->db->where('support_ticket_id', $topic['support_ticket_id']);			
			$this->db->update('support_ticket', $topic_ticket);

			$this->db->insert('support_ticket_item', $topic);
			return $this->db->insert_id();
	}
	
	/*
	Ticket category listing
	*/
	function get_ticketscategory()
	{
		return $this->db->order_by("category", "ASC")->get('support_ticket_category')->result();		
	}
	
	/*
	Delete ticket and its disscussion topics
	*/
	function delete_ticket($id)
	{
		// delete ticket 
		$this->db->where('support_ticket_id', $id);
		$this->db->delete('support_ticket');

		//delete references in the ticket to discussion table
		$this->db->where('support_ticket_id', $id);
		$this->db->delete('support_ticket_item');
	}
	
}