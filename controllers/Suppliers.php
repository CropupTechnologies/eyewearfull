<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Branch_model');
        $this->load->model('Category_model');
        $this->load->model('Product_model');
        $this->load->model('Supplier_model');
    }

    public function index() {
        if (isset($_SESSION['admin'])) {
            $data['suppliers'] = $this->Supplier_model->get_all_suppliers();
            $data['categories'] = $this->Product_model->get_all_product_types();
            $data['title'] = 'Admin | Suppliers';
            $data['main_content'] = 'admin/suppliers';
            $this->load->view('templates/admin_template', $data);
            Suppliers::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Suppliers', '');
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function add_supplier() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {

            $info = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'telephone' => $this->input->post('telephone'),
                'mobile' => $this->input->post('mobile'),
                'fax' => $this->input->post('fax'),
                'contact_person' => $this->input->post('contact_person'),
                'address' => $this->input->post('address'),
                'category' => $this->input->post('category'),
            );

            $res = $this->Supplier_model->add_supplier($info);
            if ($res) {
                Suppliers::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Supplier', $info['name']);
            } else {
                $error_no = 591;
                Suppliers::AddAuditTrailEntry(AUDITTRAIL_WARNING, 'Add Supplier', '');
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function edit_supplier() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {

            $info = array(
                'id' => $this->input->post('id'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'telephone' => $this->input->post('telephone'),
                'mobile' => $this->input->post('mobile'),
                'fax' => $this->input->post('fax'),
                'contact_person' => $this->input->post('contact_person'),
                'address' => $this->input->post('address'),
                'category' => $this->input->post('category'),
            );

            $res = $this->Supplier_model->edit_supplier($info);
            if ($res) {
                Suppliers::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Supplier', $info['name']);
            } else {
                $error_no = 593;
                Suppliers::AddAuditTrailEntry(AUDITTRAIL_WARNING, 'Update Supplier', '');
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

}
