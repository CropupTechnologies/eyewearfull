<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
//            trigger_error("test");
//		$this->load->view('welcome_message');
//        throw new Exception('Test');
        $data['main_content'] = 'site/main_page';
        $this->load->view('templates/site_template', $data);
    }

    public function test_page() {
        $this->load->model('Itemmodel');
        $this->load->model('Category_model');
//        $data['categories'] = $this->Category_model->get_all_categories(1);
//        $data['items'] = $this->Itemmodel->get_all_items(1);
//        $data['title'] = 'Admin | Test';
//        $data['main_content'] = 'admin/test_page';
//        $data['test_content'] = $this->load->view('admin/includes/search_item', $data, TRUE);
//        $this->load->view('templates/admin_template', $data);
        echo date_default_timezone_get();
    }

}
