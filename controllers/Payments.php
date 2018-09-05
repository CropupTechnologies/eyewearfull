<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Invoice_model');
        $this->load->model('Payment_model');
        
    }

    public function payment_process() {
        if (isset($_SESSION['admin'])) {
            $invoice_id = $this->uri->segment(3);
            if (isset($invoice_id) && $invoice_id > 0) {
                $data['mode_of_payments'] = $this->Payment_model->get_all_mode_of_payments();
                $data['invoice_details'] = $this->Invoice_model->get_invoice_details_by_id($invoice_id);
                $data['title'] = 'Admin | Payment Process';
                $data['main_content'] = 'admin/payment_process';
                $this->load->view('templates/admin_template', $data);
            } else {
                //invoice id not found
                redirect(base_url('error/page/7'));
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function payment_process_next() {
        if (isset($_SESSION['admin'])) {
            if ($_POST['invoice_id']) {
                $invoice_id = $this->input->post('invoice_id');
                $mode_of_payment = $this->input->post('mode_of_payment');
                $total_payable = $this->input->post('total_payable');

                $data['invoice_id'] = $invoice_id;
                $data['mode_of_payment'] = $mode_of_payment;
                $data['total_payable'] = $total_payable;
                $data['fields'] = $this->Payment_model->get_mode_of_payment_fields($mode_of_payment);
                $data['invoice_details'] = $this->Invoice_model->get_invoice_details_by_id($invoice_id);
                $data['title'] = 'Admin | Payment Process';
                $data['main_content'] = 'admin/payment_process_next';
                $this->load->view('templates/admin_template', $data);
            } else {
                redirect(base_url('error/page/782'));
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function payment_save() {
        if (isset($_SESSION['admin'])) {
            $this->db->trans_begin();
            $info = array(
                'amount' => $this->input->post('amount'),
                'payment_method' => $this->input->post('mode_of_payment'),
                'invoice_id' => $this->input->post('invoice_id'),
                'currency_id' => 1,
            );

            $payment_id = $this->Payment_model->create_payment($info);
            //get mode of payment fields and get their values
            $parameter = $this->Payment_model->get_mode_of_payment_fields($info['payment_method']);
            if (!empty($parameter)) {
                for ($x = 0; $x < count($parameter); $x++) {
                    $params[$x] = array(
                        'payment_id' => $payment_id,
                        'payment_field_id' => $parameter[$x]['mod_field_id'],
                        'value' => $this->input->post($parameter[$x]['field_id']),
                    );
                }
                if (isset($payment_id) && $payment_id > 0) {
                    $res = $this->Payment_model->add_payment_field_data($params);
                    if ($res) {
                        $this->db->trans_commit();
                        redirect(base_url('admin/invoice'));
                    } else {
                        $this->db->trans_rollback();
                    }
                }
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

}
