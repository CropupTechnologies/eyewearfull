<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_action extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('itemmodel');
        $this->load->model('Sed_core_user');
        $this->load->model('Color_model');
    }

    public function add_brand() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $user_id = $_SESSION['admin']['id'];
            $brand_name = $this->input->post('brand-name');
            $brand_logo = $this->input->post('brand-logo');
            if ($brand_name != null && strlen(trim($brand_name)) > 0) {
                if (!$this->itemmodel->add_brand($brand_name, $brand_logo, $user_id)) {
                    $error_no = 201;
                } else {
                    Admin_action::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Brand', "ID: " . $this->db->insert_id());
                }
            }
        } else {
            $error_no = 1;
            $error = $this->config->item(1, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function add_news() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $user_id = $_SESSION['admin']['id'];
            $news_title = $this->input->post('news-title');
            $news_content = $this->input->post('news-content');
            $news_expiry = date('Y-m-d', strtotime($this->input->post('news-expiry')));
            $news_image = $this->input->post('news-image');
            if ($news_title != null && strlen(trim($news_title)) > 0) {
                $this->load->model('newsmodel');
                if (!$this->newsmodel->add_news($news_title, $news_content, $news_expiry, $news_image, $user_id)) {
                    $error_no = 201;
                } else {
                    Admin_action::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'News Item', "ID: " . $this->db->insert_id());
                }
            }
        } else {
            $error_no = 1;
            $error = $this->config->item(1, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function add_user() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $user_id = $_SESSION['admin']['id'];
            $name = $this->input->post('name');
            $username = $this->input->post('user-name');
            $password = $this->input->post('password');
            $type = $this->input->post('type');
            $recovery_email = $this->input->post('recovery-email');
            $recovery_phone = $this->input->post('recovery-phone');
            if (!Sed_core_user::add_user($name, $username, $password, $type, $recovery_email, $recovery_phone, $user_id)) {
                $error_no = 151;
            } else {
                Admin_action::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'User', "ID: " . $this->db->insert_id());
            }
        } else {
            $error_no = 1;
            $error = $this->config->item(1, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function edit_brand() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $user_id = $_SESSION['admin']['id'];
            $brand_name = $this->input->post('brand-name');
            $brand_image = $this->input->post('brand-image');
            $brand_id = $this->input->post('brand-id');
            $res = $this->itemmodel->edit_brand($brand_id, $brand_name, $brand_image, $user_id);
            if (!$res) {
                $error_no = 203;
            } else {
                Admin_action::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Brand', "ID: " . $brand_id);
            }
        } else {
            $error_no = 1;
            $error = $this->config->item(1, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function edit_news() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $user_id = $_SESSION['admin']['id'];
            $news_id = $this->input->post('news-id');
            $news_title = $this->input->post('news-title');
            $news_content = $this->input->post('news-content');
            $news_expiry = $this->input->post('news-expiry');
            $news_image = $this->input->post('news-image');
            $this->load->model('newsmodel');
            $res = $this->newsmodel->edit_news($news_id, $news_title, $news_content, $news_image, $news_expiry, $user_id);
            if (!$res) {
                $error_no = 203;
            } else {
                Admin_action::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'News', "ID: " . $news_id);
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            $error = $this->config->item(1, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function edit_user() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $user_id = $this->input->post('hidden_id');
            $user_name = $this->input->post('name');
            $user_type = $this->input->post('user_type');
            $user_username = $this->input->post('user_name');
            $recovery_email = $this->input->post('recovery_email');
            $recovery_phone = $this->input->post('recovery_phone');

            $info = array(
                'id' => $user_id,
                'name' => $user_name,
                'user_type' => $user_type,
                'username' => $user_username,
                'recovery_mail' => $recovery_email,
                'recovery_phone' => $recovery_phone,
            );

            $res = $this->Sed_core_user->edit_user($info);
            if ($res) {
                Admin_action::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'User', $user_name);
            } else {
                $error_no = 156;
                Admin_action::AddAuditTrailEntry(AUDITTRAIL_WARNING, 'Upadate User', $user_name);
            }
        } else {
            redirect(base_url('admin/login_view'));
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function update_password() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['reset_code'])) {
            $reset_code = $_SESSION['reset_code'];
            $code = trim($this->input->post('reset-code'));
            if (strlen($code) > 0 && strlen($code) < 100 && $code == $reset_code) {
                $password = trim($this->input->post('password'));
                if (strlen($password) >= 8 && strlen($password) < 20) {
                    //update passsword
                    $user_id = $_SESSION['user_id'];
                    if (!$this->Sed_core_user->update_password($user_id, $password)) {
                        $error_no = 167;
                    } else {
                        unset($_SESSION['reset_code']);
                        unset($_SESSION['user_id']);
                        Admin_action::AddAuditTrailEntry(AUDITTRAIL_INFORMATION, 'Password Update', 'User ID:' . $user_id);
                    }
                } else {
                    $error_no = 166;
                }
            } else {
                $error_no = 165;
            }
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function add_color() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $info['name'] = $this->input->post('name');
            $info['color'] = $this->input->post('color');
            $info['shade'] = $this->input->post('shade');
            $info['style'] = $this->input->post('style');
            $res = $this->Color_model->add_color($info);
            if ($res) {
                $error_no = 0;
                Admin_action::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Colors', $info['name']);
            } else {
                $error_no = 551;
            }
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function edit_color() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['admin'])) {
            $info['id'] = $this->input->post('id');
            $info['name'] = $this->input->post('name');
            $info['shade'] = $this->input->post('shade');
            $info['color'] = $this->input->post('color');
            $info['style'] = $this->input->post('style');
            $res = $this->Color_model->edit_color($info);
            if ($res) {
                $error_no = 0;
                Admin_action::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Colors', $info['name']);
            } else {
                $error_no = 553;
            }
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

}
