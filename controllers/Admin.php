<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();
//        $this->load->model('itemmodel');
        $this->load->model('Sed_core_user');
        $this->load->model('Common');
        $this->load->model('Itemmodel');
        $this->load->model('Color_model');
        $this->load->model('Order_model');
    }

    public function index() {
//        session_start();
        if (isset($_SESSION['admin'])) {
            $data['title'] = 'Admin | Dashboard';
            $data['main_content'] = 'admin/dashboard';
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function brands() {
//        session_start();
        if (isset($_SESSION['admin'])) {
            $data['brands'] = $this->Itemmodel->get_all_brands(FALSE);
            $data['title'] = 'Admin | Brands';
            $data['main_content'] = 'admin/brands';
            Admin::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Brands', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function news() {
//        session_start();
        if (isset($_SESSION['admin'])) {
            $this->load->model('newsmodel');
            $data['news'] = $this->Common->get_all_rows('news');
            $data['main_content'] = 'admin/news';
            $data['title'] = 'Admin | News';
            Admin::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'News', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function login_view() {
        $data['title'] = 'Admin | Login';
        $data['common_modals'] = $this->load->view('admin/includes/common_modals', '', TRUE);
        $this->load->view('admin/login', $data);
    }

    public function login() {
//        session_start();
        $user_name = $this->input->post('username');
        $password = $this->input->post('password');
        $login = FALSE;
        if ($user_name != NULL && $password != NULL) {
            $res = Sed_core_user::login_sed_user($user_name, $password);
            if ($res != FALSE && count($res) > 0) {
                if ($res['enabled'] == 1) {
                    $_SESSION['admin'] = $res;
                    $login = TRUE;
                    Admin::AddAuditTrailEntry(AUDITTRAIL_LOGIN, 'Login Success', "Username: " . $_SESSION['admin']['name'] . "|IP: " . $this->input->ip_address());
                }
            }
        }
        if (!$login) {
            $_SESSION['message'] = $this->config->item(2, 'msg');
            Admin::AddAuditTrailEntry(AUDITTRAIL_WARNING, 'Login Fail', "Username: " . $user_name . "|IP: " . $this->input->ip_address());
        }
        redirect('admin');
    }

    public function logout() {
//        session_start();
        if (isset($_SESSION['admin'])) {
            Admin::AddAuditTrailEntry(AUDITTRAIL_LOGOUT, 'Logout', "Username: " . $_SESSION['admin']['name'] . "|IP: " . $this->input->ip_address());
            unset($_SESSION['admin']);
        }
        redirect('admin/login_view');
    }

    public function users() {
//        session_start();
        if (isset($_SESSION['admin'])) {
            $data['users'] = Sed_core_user::get_all_users();
            $data['user_types'] = Sed_core_user::get_all_user_types();
            $data['title'] = 'Admin | Users';
            $data['main_content'] = 'admin/users';
            Admin::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Users', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function reset_password($code) {
        $error_id = 0;
        if ($code != NULL) {
            $code = trim($code);
            if (strlen($code) > 0 && strlen($code) < 100) {
                //check if code is valid
                $status = $this->Sed_core_user->is_valid_code($code);
                if ($status == '0') { //valid code
                    $user = $this->Sed_core_user->get_user_by_password_reset_code($code);
                    $data['name'] = $user['name'];
                    $data['code'] = $code;
                    $data['common_modals'] = $this->load->view('admin/includes/common_modals', '', TRUE);
                    $_SESSION['reset_code'] = $code;
                    $_SESSION['user_id'] = $user['id'];
                    $this->load->view('admin/reset_password', $data);
                } else {
                    switch ($status) {
                        case 1://invalid code
                            $error_id = 161;
                            break;
                        case 2://code has been used
                            $error_id = 162;
                            break;
                        case 3://code expired
                            $error_id = 163;
                            break;
                        case 4://code expired
                            $error_id = 164;
                    }
                }
            } else {
                $error_id = 161;
            }
        } else {
            $error_id = 161;
        }
        if ($error_id > 0) {
            redirect(base_url('error/page/' . $error_id));
        }
    }

    public function colors() {
        if (isset($_SESSION['admin'])) {
            $data['colors'] = $this->Color_model->get_all_colors();
            $data['main_content'] = 'admin/colors';
            $data['title'] = 'Admin | Colors';
            Admin::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Colors', '');
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function fields() {
        if (isset($_SESSION['admin'])) {
            $data['fields'] = $this->Common->get_all_fields();
            $data['title'] = 'Admin | Metadata';
            $data['main_content'] = 'admin/fields/fields';
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

    public function add_field() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $name = $this->input->post('field-name');
            $type = $this->input->post('field-type');
            $min_value = $this->input->post('min-value');
            $max_value = $this->input->post('max-value');
            $unit = $this->input->post('unit');
            $max_characters = $this->input->post('max-characters');
            if (strlen(trim($name)) > 0) {
                if ($this->Common->add_field($name, $type, $min_value, $max_value, $unit, $max_characters, $_SESSION['admin']['id'])) {
                    Admin::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Field', '');
                } else {
                    $error_no = 443;
                }
            } else {
                $error_no = 442;
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

    public function edit_field() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $id = $this->input->post('field-id');
            if ($id != NULL && strlen(trim($id)) > 0) {
                $name = $this->input->post('field-name');
                $type = $this->input->post('field-type');
                $min_value = $this->input->post('min-value');
                $max_value = $this->input->post('max-value');
                $unit = $this->input->post('unit');
                $max_characters = $this->input->post('max-characters');
                if (strlen(trim($name)) > 0) {
                    if ($this->Common->edit_field($id, $name, $type, $min_value, $max_value, $unit, $max_characters, $_SESSION['admin']['id'])) {
                        Admin::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Field', 'ID: ' . $id);
                    } else {
                        $error_no = 448;
                    }
                } else {
                    $error_no = 442;
                }
            } else {
                $error_no = 453;
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

    public function field_values($id) {
        if (isset($_SESSION['admin'])) {
            if ($id != NULL && intval($id) > 0 && intval($id) < 9999) {
                $field = $this->Common->get_entity_by_id('field', $id);
                if ($field != FALSE) {
                    if ($field['enabled'] == 1) {
                        $data['field_data'] = $field;
                        $data['field_values'] = $this->Common->get_field_values_by_id($id);
                        $data['title'] = 'Admin | Field Values';
                        $data['main_content'] = 'admin/fields/field_values';
                        $this->load->view('templates/admin_template', $data);
                    } else {
                        redirect(base_url('error/page/7'));
                    }
                } else {
                    redirect(base_url('error/page/8'));
                }
            } else {
                redirect(base_url('error/page/6'));
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
    }
    
    public function invoice() {
        if (isset($_SESSION['admin'])) {
            $data['invoices'] = $this->Invoice_model->get_all_invoice();
            $data['title'] = 'Admin | Invoice';
            $data['main_content'] = 'admin/invoice';
            $this->load->view('templates/admin_template', $data);
        } else {
            redirect(base_url('admin/login_view'));
        }
    }

}
