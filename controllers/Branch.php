<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Branch_model');
    }

    public function index() {
        if (isset($_SESSION['admin'])) {
            $data['branches'] = $this->Branch_model->get_all_branches();
            $data['title'] = 'Admin | Branch';
            $data['main_content'] = 'admin/branch';
            $this->load->view('templates/admin_template', $data);
            Branch::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Branch', '');
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function add_branch() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $branch_name = $this->input->post('branch_name');
            $branch_telephone = $this->input->post('branch_telephone');
            $branch_address1 = $this->input->post('branch_address1');
            $branch_address2 = $this->input->post('branch_address2');
            $branch_city = $this->input->post('branch_city');
            $branch_email = $this->input->post('branch_email');
            $branch_latitude = $this->input->post('branch_latitude');
            $branch_latitude = $this->input->post('branch_longitude');

            $info = array(
                'branch_name' => $branch_name,
                'branch_telephone' => $branch_telephone,
                'branch_address1' => $branch_address1,
                'branch_address2' => $branch_address2,
                'branch_city' => $branch_city,
                'branch_email' => $branch_email,
                'branch_latitude' => $branch_latitude,
                'branch_longitude' => $branch_latitude,
            );

            $res = $this->Branch_model->add_branch($info);
            if ($res) {
                Branch::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Branch', $branch_name);
            } else {
                $error_no = 400;
                Branch::AddAuditTrailEntry(AUDITTRAIL_WARNING, 'Add Branch', '');
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function edit_branch() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $branch_id = $this->input->post('branch_id');
            $branch_name = $this->input->post('branch_name');
            $branch_telephone = $this->input->post('branch_telephone');
            $branch_address1 = $this->input->post('branch_address1');
            $branch_address2 = $this->input->post('branch_address2');
            $branch_city = $this->input->post('branch_city');
            $branch_email = $this->input->post('branch_email');
            $branch_latitude = $this->input->post('branch_latitude');
            $branch_latitude = $this->input->post('branch_longitude');

            $info = array(
                'branch_name' => $branch_name,
                'branch_telephone' => $branch_telephone,
                'branch_address1' => $branch_address1,
                'branch_address2' => $branch_address2,
                'branch_city' => $branch_city,
                'branch_email' => $branch_email,
                'branch_latitude' => $branch_latitude,
                'branch_longitude' => $branch_latitude,
            );

            $res = $this->Branch_model->edit_branch($branch_id, $info);
            if ($res) {
                Branch::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Branch', $branch_name);
            } else {
                $error_no = 403;
                Branch::AddAuditTrailEntry(AUDITTRAIL_WARNING, 'Update Branch', '');
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

}
