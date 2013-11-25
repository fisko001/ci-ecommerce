<?php

defined('BASEPATH') or die('No Direct Script Access');

require_once BASEPATH . 'libraries/Form_validation.php';

class MY_Form_validation extends CI_Form_validation
{
    public function __construct($rules = array())
    {
        parent::__construct($rules);
        $this->set_message('recaptcha_validate','Captcha Code is not valid, Are you human? ');
        exit();
    }
    
    public function recaptcha_validate($recaptcha_response_field, $recaptcha_challenge_field)
    {
        $this->CI->load->helper('recaptcha');
        $resp = bizelaw_recaptcha_check_answer($this->CI->input->ip_address(),$_POST[$recaptcha_challenge_field], $recaptcha_response_field);
        
        //return $resp->is_valid;
        echo "IS this called"; exit();
    }
}