<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->model('Itemmodel');
        $this->load->model('Promotion_model');
    }

    public function index() {
        if (isset($_SESSION['admin'])) {
            $data['title'] = 'Admin | Products';
            $data['promotions'] = $this->Promotion_model->get_all_promotions(TRUE);
            $data['main_content'] = 'admin/promotions';
            Promotion::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Promotions', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function promotion_items() {
        if (isset($_SESSION['admin'])) {
            $data['categories'] = $this->Category_model->get_all_categories(1);
            $data['items'] = $this->Itemmodel->get_all_items(1);
            $data['search_item_html'] = $this->load->view('admin/includes/search_item', $data, TRUE);
            $data['promotions'] = $this->Promotion_model->get_all_promotions();
            $data['title'] = 'Admin | Promotion Items';
            $data['main_content'] = 'admin/add_promotion';
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function add_promotion_items() {
        $error_no = 0;
        $error = '';
        $item = null;
        if (isset($_SESSION['admin'])) {
            $info = array(
                'item_id' => $this->input->post('item_id'),
                'promotion_id' => $this->input->post('promotion_id'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
            );

            $res = $this->Promotion_model->add_promotion_items($info);
            if ($res) {
                $error_no = 830;
            } else {
                $error_no = 831;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function add_promotion() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $info = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'type' => $this->input->post('type'),
                'value_type' => $this->input->post('value_type'),
                'value' => $this->input->post('value'),
                'ui_class' => $this->input->post('ui_class'),
                'min_qty' => $this->input->post('min_qty'),
                'min_total' => $this->input->post('min_amount'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
            );

            if (!$this->Promotion_model->add_promotion($info)) {
                $error_no = 201;
            } else {
                Promotion::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Promotion', "ID: " . $this->db->insert_id());
            }
        } else {
            $error_no = 1;
            $error = $this->config->item(1, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }
    
    public function edit_promotion() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $info = array(
                'id' => $this->input->post('id'),
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'type' => $this->input->post('type'),
                'value_type' => $this->input->post('value_type'),
                'value' => $this->input->post('value'),
                'ui_class' => $this->input->post('ui_class'),
                'min_qty' => $this->input->post('min_qty'),
                'min_total' => $this->input->post('min_amount'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
            );

            if (!$this->Promotion_model->edit_promotion($info)) {
                $error_no = 835;
            } else {
                Promotion::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Promotion', "ID: " . $this->db->insert_id());
            }
        } else {
            $error_no = 1;
            $error = $this->config->item(1, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

}
