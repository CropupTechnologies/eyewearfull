<?php

class Product_type extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Branch_model');
        $this->load->model('Category_model');
        $this->load->model('Product_model');
        $this->load->model('Supplier_model');
    }

    public function index() {
        if (isset($_SESSION['admin'])) {
            $data['categories'] = $this->Product_model->get_all_product_types();
            $data['title'] = 'Admin | Product Type';
            $data['main_content'] = 'admin/product_type';
            $this->load->view('templates/admin_template', $data);
            Product_type::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Product Type', '');
        } else {
            redirect(base_url('admin/login_view'));
        }
    }
    
    public function add_product_type() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {

            $info = array(
                'name' => $this->input->post('name'),
            );

            $res = $this->Product_model->add_product_type($info);
            if ($res) {
                Product_type::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Product Type', $info['name']);
            } else {
                $error_no = 591;
                Product_type::AddAuditTrailEntry(AUDITTRAIL_WARNING, 'Add Product Type', '');
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }
    
    public function edit_product_type() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {

            $info = array(
                'id' => $this->input->post('id'),
                'name' => $this->input->post('name'),
                
            );

            $res = $this->Product_model->edit_product_type($info);
            if ($res) {
                Product_type::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Product Type', $info['name']);
            } else {
                $error_no = 653;
                Product_type::AddAuditTrailEntry(AUDITTRAIL_WARNING, 'Product Type', '');
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

}
