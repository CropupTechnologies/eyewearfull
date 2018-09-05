<?php

class Report extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Order_model');
        $this->load->model('Payment_model');
    }

    public function pending_orders() {
        if (isset($_SESSION['admin'])) {
            $data['orders'] = $this->Order_model->get_all_pending_orders();
            $data['title'] = 'Admin | Pending Orders';
            $data['main_content'] = 'admin/reports/pending_orders';
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function cash_receipts() {
        if (isset($_SESSION['admin'])) {
            $data['mode_of_payments'] = $this->Payment_model->get_all_mode_of_payments();
            if (isset($_POST['filter'])) {
                $from = $this->input->post('fromDate');
                $to = $this->input->post('toDate');
                $mop = $this->input->post('mode_of_payment');
                $data['to'] = $to;
                $data['from'] = $from;
                $data['select_mop'] = $mop;
                $data['cash_receipts'] = $this->Payment_model->get_all_payments($from, $to, $mop);
            } else {
                //Default Report
                $data['cash_receipts'] = $this->Payment_model->get_all_payments();
                $data['to'] = null;
                $data['from'] = null;
                $data['select_mop'] = 'null';
            }

            $data['title'] = 'Admin | Cash Receipts';
            $data['main_content'] = 'admin/reports/cash_receipt';
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

}
