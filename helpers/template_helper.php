<?php
/**
 * This applies to public site, elaw seek site, and recruiter site only
 */

if(!function_exists('get_template_partial'))
{
        function get_template_partial($partial_file_name)
        {
                $ci = & get_instance();
                $ci->load->view(APPPATH . 'views/includes/'. $partial_file_name );
        }
}
if(!function_exists('get_header'))
{
        function get_header()
        {
                get_template_partial('header'. EXT);
        }
}
if(!function_exists('get_footer'))
{
        function get_footer()
        {
                get_template_partial('footer'. EXT);
        }
}
if(!function_exists('get_elaw_seek_navigation'))
{
        function get_elaw_seek_nagivation()
        {
                get_template_partial('elaw_seek_navigation'. EXT);
        }
}
if(!function_exists('get_elaw_recruit_navigation'))
{
        function get_elaw_recruit_navigation()
        {
                get_template_partial('elaw_recruit_navigation'. EXT);
        }
}

if(!function_exists('show_company_logo'))
{
        function show_company_logo($entity_id, $entity_name, $anonymous_posting = TRUE)
        {
                $ci = & get_instance();
                $ci->config->load('file', TRUE);
                $base_path = $ci->config->item('companies_logo_url_base', 'file');
                $default_logo = $ci->config->item('companies_default_logo', 'file');
                $entity_logo = "";
                if($entity_name == "AUS Large Firm")
                        $entity_logo = $ci->config->item('companies_logo_url_large', 'file');
                if($entity_name == "AUS Medium Firm")
                        $entity_logo = $ci->config->item('companies_logo_url_medium', 'file');
                if($entity_name == "AUS Small Firm")
                        $entity_logo = $ci->config->item('companies_logo_url_small', 'file');
                if($entity_name == "International Law Firm")
                        $entity_logo = $ci->config->item('companies_logo_url_international', 'file');
                
                if($anonymous_posting)
                {
                        if($entity_logo!="")
                        {
                                return "<img src='{$base_path}/{$entity_logo}' />";
                        }else{
                                return "<img src='{$base_path}/{$default_logo}' />";
                        }
                }
                else
                {
                        $ci->load->model('recruiters/entity_model');
                        $recruiter = $ci->entity_model->get($entity_id);
                        
                        $company_url = $recruiter['url'];
                        if(!empty($company_url))
                        {
                                $url_link = $recruiter['url'];
                        }
                        else
                        {
                                $url_link = '#';
                        }
                        if($entity_logo!="")
                        {
                                return "<img src='{$base_path}/{$entity_logo}' alt=''/>";
                        }
                        else
                        {
                                if(!empty ($recruiter['logo_file_path'])){
                                     
                                        return "<a href='$url_link' target='_blank' ><img src='{$base_path}/{$recruiter['logo_file_path']}' alt=''/></a>";   
                                        
                                }else{
                                        return "<img src='{$base_path}/{$default_logo}' alt='' />";
                                }
                        }
                }
        }
}
