<?php

$data['title'] = $title;
$this->load->view('admin/includes/admin_common_header',$data);
$this->load->view('admin/includes/nav_bar');

//$this->load->view('preloder');
$this->load->view($main_content);
$this->load->view('admin/includes/admin_common_footer');
?>
