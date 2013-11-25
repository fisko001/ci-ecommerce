<?php

defined('BASEPATH') or die('No direct Script Access');


$config['use_page_numbers'] = TRUE;
$config['full_tag_open']    = '<div class="pagination"><ul class="pages">';
$config['full_tag_close']   = '<ul></div>';
$config['num_tag_open']     = '<li>';
$config['num_tag_close']    = '</li>';
$config['cur_tag_open']     = '<li><a class="active" href="#">';
$config['cur_tag_close']    = '</a></li>';
$config['prev_tag_open']    = '<li class="prev">';
$config['prev_tag_close']   = '</li>';
$config['next_tag_open']    = '<li class="next">';
$config['next_tag_close']   = '</li>';
$config['last_link']        = '>|';
$config['last_tag_open']    = '<li class="next">';
$config['last_tag_close']   = '</li';
$config['first_link']        = '|<';
$config['first_tag_open']    = '<li class="prev">';
$config['first_tag_close']   = '</li';
$config['per_page']          = 20;   