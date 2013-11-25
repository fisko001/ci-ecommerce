<?php
class Page_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
     * function for get_page_by_permalink
     */
    public function get_page_by_permalink($permalink)
    {
        $this->db->where('permalink',$permalink);
        $query = $this->db->get('cms_pages');
        return $query->row();
    }
}

?>