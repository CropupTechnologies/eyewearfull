<?php
$this->load->view('site/includes/site_common_header');
$this->load->view("site/includes/header");
//$this->load->view('preloader');
$this->load->view($main_content);
$this->load->view('admin/includes/common_modals');
$this->load->view("site/includes/footer");
$this->load->view('site/includes/site_common_footer');
$data['header'] = $this->load->view("site/includes/footer", '', TRUE);
?>

