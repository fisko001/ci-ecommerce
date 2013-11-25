<?php
defined('BASEPATH') OR die('No Direct Script Access');

/**
 * Parameters_model
 * 
 * This acts a model for every system parameters
 * 
 */
class Parameters_model extends CI_Model
{   
    protected $table;
    
    protected $insert_id;
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
    /**
     * Sets the current parameter table
     * 
     * @param string $table 
     */
    public function set_table($table)
    {
        $this->table = $table;
    }
    
    public function get_table()
    {
        return $this->table;
    }
    /**
     * Returns the name correspoding to given name
     * 
     * @param $id 
     * @return string the name corresponding to that id
     */
    public function get($id)
    {
        if(!isset($this->table))   return FALSE;
        // @TODO some stuffs to check logic   
        $query = $this->db->select('id, name, order, published')->where('id',$id)->get($this->table);
        return $query->num_rows() > 0 ? $query->row() : FALSE;
    }
    /**
     *
     * @param int $id id of the parameter
     * @return bool name of the parameter
     */
    public function get_name($id)
    {
        $row = $this->get($id);
        if ( ! $row )
        {
            return FALSE;
        }
        return $row->name;
    }

    /**
     *  All parameters of current table
     * 
     * @return array Array containing all the published parameters
     * @param bool $include_unpublished whether to include unpublished as well or not
     */
    public function all($include_unpublished = FALSE) 
    {
        if(!isset($this->table))
        {
            return FALSE;
        }
        if($include_unpublished)
        {
            $query = $this->db->select('id, name, order, published')->order_by('order','ASC')->get($this->table);
        } else
        {
            $query = $this->db->select('id, name, order, published')->where('published',1)->order_by('order','ASC')->get($this->table);
        }
        return $query->num_rows() > 0 ? $query->result_array() : FALSE;
    }
    
    public function all_selected($id,$params,$include_unpublished = FALSE) 
    {
        if(!isset($this->table))
        {
            return FALSE;
        }
        if($include_unpublished)
        {
            $query = $this->db->select('id, name, order, published','countries_id')->order_by('order','ASC')->get($this->table);
        } else
        {
            $query = $this->db->select('id, name, order, published','countries_id')->where($params,$id)->order_by('order','ASC')->get($this->table);
        }
        return $query->num_rows() > 0 ? $query->result_array() : FALSE;
    }
    
    public function rate_selected($id,$include_unpublished = FALSE) 
    {
        if(!isset($this->table))
        {
            return FALSE;
        }
        if($include_unpublished)
        {
            $query = $this->db->select('id, name, order, published')->order_by('order','ASC')->get($this->table);
        } else
        {
            $query = $this->db->select('id, name, order, published')->where('rate_type',$id)->order_by('order','ASC')->get($this->table);
        }
        return $query->num_rows() > 0 ? $query->result_array() : FALSE;
    }
    
    /**
     * Adds new parameter
     * 
     * @param type $name name value
     * @param bool $published if the parameter is to be initially published
     * @return type 
     */
    public function add($name, $published = FALSE, $order)
    {
        if(!isset($this->table)) return FALSE;
        $data = array (
                'name' => $name,
                'published' => $published ? 1:0,
                'order' => $order
        );
        if ($this->db->insert($this->table, $data))
        {
            $this->insert_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
        
    }
    
    /**
     * Mass delete all the parameters
     * 
     * @param type $numbers a number or array of id numbers
     * @return bool TRUE for successful, otherwise false
     */
    public function delete($ids=array())
    {
        if(!isset($this->table)) return FALSE;
        
        if(!is_array($ids))
        {
            $ids = array($ids);
        }
        if(empty ($ids)) return FALSE;
        foreach ($ids as $id)
        {
            if(!$this->db->delete($this->table,array('id' => $id))) return FALSE;
        }
        return TRUE;
    }
    /**
     * Publishes given array of ids
     * 
     * @param type $ids
     * @return bool
     */
    public function publish($ids = array(), $unpublish = FALSE)
    {
        if(!isset($this->table)) return FALSE;
        if(!is_array($ids))
        {
            $ids = array($ids);
        }
        if(empty ($ids)) return FALSE;
        $value = $unpublish ? 0 : 1;
        return $this->db->where_in('id', $ids)->update($this->table, array('published'=> $value));
    }
    
    /**
     * Wrapper around publish function for unpublish function
     * 
     * @param type $ids ids
     * @return boolean
     */
    public function unpublish($ids = array())
    {
        return $this->publish($ids, TRUE);
    }
    
    public function update($id,$name,$published, $order = 0)
    {
        if(!isset($this->table)) return FALSE;
        $value = $published ? 1 : 0;
        return $this->db->where('id', (int) $id)->update($this->table, array('published'=> $value,
                                                                            'name' => $name,
                                                                            'order' => $order ));
        
    }
    /**
     * check if the parameter with given name exists
     * 
     * @param type $name
     * @param type $id
     * @return type 
     */
    public function parameter_check($name,$id = FALSE)
    {
        $q = $this->db->like('name',$name);
        if(isset($id))
        {
            $q = $q->where('id !=', (int) $id);
        }
        $query = $q->limit(1)->get($this->table);
        return $query->num_rows() > 0;
    }
    
}