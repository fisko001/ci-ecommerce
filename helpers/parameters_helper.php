<?php defined('BASEPATH') or die('No direct Script Access!');

if ( ! function_exists('_get_parameters'))
{
	function _get_parameters($table)
	{
		$CI =& get_instance();
                $CI->load->model('parameters_model');
                $parameter_model = $CI->parameters_model;
                $parameter_model->set_table($table);
		return $parameter_model->all(); 
	}
}

if( ! function_exists('_get_params_by_id'))
{
        function _get_params_by_id($table,$id,$params)
	{
		$CI =& get_instance();
                $CI->load->model('parameters_model');
                $parameter_model = $CI->parameters_model;
                $parameter_model->set_table($table);
		return $parameter_model->all_selected($id,$params); 
	}
}

if( ! function_exists('_get_params_by_value'))
{
        function _get_params_by_value($table,$value)
	{
		$CI =& get_instance();
                $CI->load->model('parameters_model');
                $parameter_model = $CI->parameters_model;
                $parameter_model->set_table($table);
		return $parameter_model->rate_selected($value); 
	}
}

if ( ! function_exists('_get_parameters_id'))
{
	function _get_parameters_id($table)
	{
                $data = _get_parameters($table);
                $ids = array();
                foreach ($data as $values)
                {
                    if (is_array($values))
                    {
                        if (isset($values['id']))
                        {
                            $ids[] = $values['id'];
                        }
                    }
                }
                return $ids;
                
	}
}


if ( ! function_exists('get_work_types'))
{
	function get_work_types()
	{
		return _get_parameters('work_types');
	}
}

if ( ! function_exists('get_work_types_id'))
{
	function get_work_types_id()
	{
		return _get_parameters_id('work_types');
	}
}

if ( ! function_exists('get_practice_areas'))
{
	function get_practice_areas()
	{
		return _get_parameters('practice_areas');
	}
}

if ( ! function_exists('get_practice_areas_id'))
{
	function get_practice_areas_id()
	{
		return _get_parameters_id('practice_areas');
	}
}

if ( ! function_exists('get_job_types'))
{
	function get_job_types()
	{
		return _get_parameters('job_types');
	}
}

if ( ! function_exists('get_job_types_id'))
{
	function get_job_types_id()
	{
		return _get_parameters_id('job_types');
	}
}
if ( ! function_exists('get_locations'))
{
	function get_locations()
	{
		return _get_parameters('locations');
	}
}

if ( ! function_exists('get_locations_id'))
{
	function get_locations_id()
	{
		return _get_parameters_id('locations');
	}
}
//---------------------------------------------------------------

if ( ! function_exists('create_parameters_dropdown'))
{
	function create_parameters_dropdown($table,$selected=NULL,$have_blank=FALSE)
	{
		$parameters = _get_parameters($table);
                $options = array();
				
				if($have_blank)
				   $options['']="";
				 
                foreach($parameters as $parameter)
                {
                    $options[$parameter['id']] = $parameter['name'];
                }
                $CI = &get_instance();
                $CI->load->helper('form');
                return form_dropdown($table.'_id',$options,$selected, "id=\"$table\"_id");
	}
}


if ( ! function_exists('create_experiences_dropdown'))
{
	function create_experiences_dropdown($selected=NULL,$have_blank=FALSE)
	{
		$parameters = _get_parameters('experiences');
                
                $options = array();
                $options = array();
				
				if($have_blank)
				   $options['']="";
                foreach($parameters as $parameter)
                {
                    $options[$parameter['name']] = $parameter['name'];
                }
                $CI = &get_instance();
                $CI->load->helper('form');
                return form_dropdown('experience',$options,$selected);
	}
}

if ( ! function_exists('create_titles_dropdown'))
{
	function create_titles_dropdown($selected='')
	{
		$parameters = _get_parameters('user_titles');
                $options = array();
			     $options['']="";
				
                foreach($parameters as $parameter)
                {
                    $options[$parameter['name']] = $parameter['name'];
                }
		         $CI = &get_instance();
                $CI->load->helper('form');
                $css = 'class="lapseClass"';                        
                return form_dropdown('title',$options,$selected,$css);
	}
}
if ( ! function_exists('create_admin_titles_dropdown'))
{
	function create_admin_titles_dropdown($selected='')
	{
		$parameters = _get_parameters('user_titles');
                $options = array();
			     //$options['']="";
				
                foreach($parameters as $parameter)
                {
                    $options[$parameter['name']] = $parameter['name'];
                }
		         $CI = &get_instance();
                $CI->load->helper('form');
                $css = 'class="lapseClass"';                        
                return form_dropdown('title',$options,$selected,$css);
	}
}

if ( ! function_exists('get_pages'))
{
        function get_pages()
        {
            $CI =& get_instance();
            $CI->db->order_by('order','ASC');
            return $CI->db->get('cms_pages')->result();
            
        }
}

if ( ! function_exists('get_countries'))
{
        function get_countries()
        {
            $CI =& get_instance();
            $CI->db->order_by('order','ASC');
            $CI->db->where('published','1');
            return $CI->db->get('countries')->result();
            
        }
}
if ( ! function_exists('get_countries_by_id'))
{
        function get_countries_by_id($id)
        {
            $CI =& get_instance();
            $CI->db->order_by('order','ASC');
            $CI->db->where('published','1');
            $CI->db->where('id',$id);
            return $CI->db->get('countries')->row()->name;
            
        }
}
if( ! function_exists('rate_params_dropdown'))
{
        function rate_params_dropdown($table,$selected = '')
        {
                $parameters = _get_parameters($table);
                $options = array();
			     //$options['']="";
				
                foreach($parameters as $parameter)
                {
                    $options[$parameter['id']] = $parameter['name'];
                }
                $CI = &get_instance();
                $CI->load->helper('form');
                $css = 'class="lapseClass"';                        
                return form_dropdown($table.'_id',$options,$selected,$css);
        }
}
if( ! function_exists('rate_dropdown'))
{
        function rate_dropdown($table,$selected = '')
        {
                $parameters = _get_parameters($table);
                $options = array();
			     //$options['']="";
				
                foreach($parameters as $parameter)
                {
                    $options[$parameter['id']] = $parameter['name'];
                }
                $CI = &get_instance();
                $CI->load->helper('form');
                $css = 'class="lapseClass"';                        
                return form_dropdown($table.'_id',$options,$selected,$css);
        }
}

if( ! function_exists('state_dropdown_country_match'))
{
        function state_dropdown_country_match($table,$selected = '',$id,$params)
        {
                $parameters = _get_params_by_id($table,$id,$params);
                
                $options = array();
			     //$options['']="";
                
		if(is_array($parameters)){		
                        foreach($parameters as $parameter)
                        {
                        $options[$parameter['id']] = $parameter['name'];
                        }
                        $CI = &get_instance();
                        $CI->load->helper('form');
                        //$css = 'class="lapseClass"';                        
                        return form_dropdown($table.'_id',$options,$selected);
                }else{
                        $CI = &get_instance();
                        $CI->load->helper('form');
                        //$css = 'class="lapseClass"';               
                        return form_dropdown($table.'_id',$options,$selected);
                }
        }
}

if( ! function_exists('rates_dropdown_match'))
{
        function rates_dropdown_match($table,$selected = '',$value)
        {
                $parameters = _get_params_by_value($table,$value);
                
                $options = array();
			     //$options['']="";
                
		if(is_array($parameters)){		
                        foreach($parameters as $parameter)
                        {
                        $options[$parameter['id']] = $parameter['name'];
                        }
                        $CI = &get_instance();
                        $CI->load->helper('form');
                        $css = 'class="widthmore"';                        
                        return form_dropdown($table.'_id',$options,$selected,$css);
                }else{
                        $CI = &get_instance();
                        $CI->load->helper('form');
                        $css = 'class="widthmore"';               
                        return form_dropdown($table.'_id',$options,$selected,$css);
                }
        }
}

if(! function_exists('countries_list'))
{
        function countries_list()
        {
                $parameters = get_countries();
                $options = array();
                if(is_array($parameters)){		
                        foreach($parameters as $parameter)
                        {
                        $options[] = '<li><a href="'.site_url('country/'.$parameter->id).'"><img src="'.base_url().'/contents/flags/'. $parameter->icon.'" alt="" />'.$parameter->name.'</a></li>';
                        }
                return $options;
                }
                
        }
}
if(! function_exists('countries_dropdown'))
{
        function countries_dropdown($table,$selected = '',$value)
        {
                $parameters = get_countries();
                $options = array();
                $options['']="";
                if(is_array($parameters)){		
                        foreach($parameters as $parameter)
                        {
                        $options[$parameter->id] = $parameter->name;
                        }
                        $CI = &get_instance();
                        $CI->load->helper('form');
                        $css = 'class="lapseClass" id='.$table.'_id';                        
                        return form_dropdown($table.'_id',$options,$selected,$css);
                
                }
                
        }
}

if(! function_exists('location_dropdown'))
{
        function location_dropdown($country_id)
        {
                $parameters = get_locations_by_id($country_id);
                $options = array();
                $options['']="";
                if(is_array($parameters)){		
                        foreach($parameters as $parameter)
                        {
                        $options[$parameter->id] = $parameter->name;
                        }
                        $CI = &get_instance();
                        $CI->load->helper('form');
                        $css = 'class="lapseClass" id="locations"';                        
                        return form_dropdown('locations_id',$options,'',$css);
                }
                
        }
}
if(! function_exists('get_locations_by_id'))
{
        function get_locations_by_id($countriesId)
        {
                $sql = "select locations.id, 
                        states.countries_id, 
                        locations.name from locations 
                        join states on states.id = locations.states_id 
                        join countries on countries.id = states.countries_id 
                        where countries.id = ?";
                $CI = &get_instance();
                $query = $CI->db->query($sql,array($countriesId));
                return $query->result();
        }
}
if( ! function_exists('credit_avilable'))
{
        function credit_avilable($userId)
        {
                $sql = "select credit_avilable from recruiter_credits WHERE userid = ?";
                $CI  = &get_instance();
                $query = $CI->db->query($sql,array($userId));
                return $query->row()->credit_avilable;
        }
}
if( ! function_exists('currency_code'))
{
        function currency_code($entity_id)
        {
                $sql = "SELECT 
                        currency.currency_code, 
                        entities.id as entities_id, 
                        currency.id 
                        FROM currency 
                        join rates on rates.currency_id = currency.id 
                        join entities on entities.rates_id = rates.id 
                        WHERE entities.id = ?";
                $CI = &get_instance();
                $query = $CI->db->query($sql,array($entity_id));
                return $query->row();
                
        }
}

if(! function_exists('company_rate'))
{
        function company_rate($entity_id)
        {
                $sql = "SELECT 
                        rate_params.rate_incl,
                        rate_params.id,
                        entities.id as entity_id,
                        rates.id as rates_id, 
                        tax.tax_value
                        FROM `rate_params` 
                        join rates on rate_params.rates_id = rates.id 
                        join entities on entities.rates_id = rates.id 
                        join tax on tax.id = rates.tax_id 
                        where entities.id = ? 
                        order by rate_params.id 
                        ASC 
                        limit 1";
                $CI = &get_instance();
                $query = $CI->db->query($sql,array($entity_id));
                return $query->row();
        }
}
if( ! function_exists('get_account_type'))
{
        function get_account_type($entityId)
        {
                $sql = "SELECT account_type from entities WHERE id = ?";
                $CI = &get_instance();
                $query = $CI->db->query($sql,array($entityId));
                return $query->row();
        }
}