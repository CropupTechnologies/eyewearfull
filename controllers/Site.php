<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {

    private $preferences;

    function __construct() {
        parent::__construct();
        $this->load->model('Search_model');
        $this->load->model('Customer_model');
        $this->load->model('Itemmodel');
        $this->load->model('Common');
        $this->load->model('Order_model');
        $this->load->model('Product_model');
        $this->preferences = $this->Common->get_preferences();
    }

    public function index() {
        $data['random_items'] = $this->Itemmodel->get_random_items();
        $data['random_products'] = $this->Product_model->get_random_products();
        $data['main_content'] = 'site/main_page';
        $this->load->view('templates/site_template', $data);
    }

    public function product_item() {
        $data['main_content'] = 'site/product_item';
        $this->load->view('templates/site_template', $data);
    }

    public function product_list() {
        $data['main_content'] = 'site/product_list';
        $this->load->view('templates/site_template', $data);
    }

    public function add_to_cart() {
        $error_no = 0;
        $error = '';
        $item_exists = false;
        $cart_data = [];
        $item_id = $this->input->post('item-id');
        if ($item_id > 0) {
            $qty = $this->input->post('qty');
            if ($qty == NULL) {
                $qty = 1;
            }
            $cart_data_json = get_cookie('shopping_cart');
            if ($cart_data_json != NULL) {
                $cart_data = json_decode($cart_data_json, TRUE);
                foreach ($cart_data as $cart_item) {
                    if ($cart_item['item'] == $item_id) {
                        $item_exists = TRUE;
                        $error_no = 700;
                        break;
                    }
                }
            }
            if (!$item_exists) {
                if (ALLOW_ORDER_OUT_OF_STOCKS == TRUE) {
                    //allow out of order
                    $cart_data[] = [
                        'item' => $item_id,
                        'qty' => $qty,
                        'enabled' => TRUE
                    ];
                    Site::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Cart Item', "Item ID:" . $item_id);
                } else {
                    //not allow out of order
                    $stock_qty = $this->Itemmodel->item_avalibale_qty_by_item_id($item_id);
                    if ($stock_qty >= $qty && $stock_qty != null) {
                        $cart_data[] = [
                            'item' => $item_id,
                            'qty' => $qty,
                            'enabled' => TRUE
                        ];
                        Site::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Cart Item', "Item ID:" . $item_id);
                    } else {
                        $error_no = 718;
                    }
                }
            }
        } else {
            $error_no = 6;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        set_cookie('shopping_cart', json_encode($cart_data), "345600");
        echo json_encode(['error_no' => $error_no, 'message' => $error]);
    }

    public function update_cart() {
        if ($_POST['update_item_id']) {
            $update_item_id = $this->input->post('update_item_id');
            $update_item_qty = $this->input->post('update_item_qty');
            $update_item_price = $this->input->post('update_item_price');
            if ($update_item_qty > 0 && $update_item_qty != "") {
                $cart_data_json = get_cookie('shopping_cart');
                if ($cart_data_json != NULL) {
                    $cart_data = json_decode($cart_data_json, TRUE);
                    for ($x = 0; $x < count($cart_data); $x++) {
                        if ($cart_data[$x]['item'] == $update_item_id) {
                            $cart_data[$x] = [
                                'item' => $update_item_id,
                                'qty' => $update_item_qty,
                                'enabled' => TRUE
                            ];
                        } else {
                            //$cart_data[] = $cart_item;
                        }
                    }
                }
                set_cookie('shopping_cart', json_encode($cart_data), "345600");
            }
        } else {
            //item Id not find
        }
    }

    public function XXXremove_from_cart() {
        $error_no = 0;
        $error = '';
        $item_id = $this->input->post('item-id');
        $new_cart_items = [];
        $item_removed = FALSE;
        if ($item_id > 0) {
            $cart_data_json = get_cookie('shopping_cart');
            if ($cart_data_json != NULL) {
                $cart_data = json_decode($cart_data_json, TRUE);
                foreach ($cart_data as $cart_item) {
                    if ($cart_item['item'] == $item_id) {
                        $item_removed = TRUE;
                        $cart_item['enabled'] = FALSE;
                    }
                    $new_cart_items[] = $cart_item;
                }
            }
            if (!$item_removed) {
                $error = 703;
            }
        } else {
            $error_no = 6;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        set_cookie('shopping_cart', json_encode($new_cart_items), "345600");
        echo json_encode(['error_no' => $error_no, 'message' => $error]);
    }

    public function shopping_cart() {
        $cart_items_json = get_cookie('shopping_cart');
        $cart_items = [];
        if ($cart_items_json != NULL) {
            $cart_items = json_decode($cart_items_json, TRUE);
            for ($i = 0; $i < count($cart_items); $i++) {
                $cart_items[$i]['item_data'] = $this->Itemmodel->get_item_by_id($cart_items[$i]['item'], '215x120');
            }
        }
        if (count($cart_items) > 0) {
//        $data['recent_items'] = $this->Search_model->get_recent_items();

            $data['cart_items'] = $cart_items;
            Site::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Shopping Cart', "");
            $data['main_content'] = 'site/shopping_cart';
            $this->load->view('templates/site_template', $data);
        } else {
            redirect(base_url('error/page/716'));
        }
    }

    public function order_process() {
        $data['id_types'] = $this->Common->get_enum_values('customer', 'gov_id_type');
        $cart_items_json = get_cookie('shopping_cart');
        $cart_items = [];
        if (isset($_SESSION['customer'])) {
            $data['customer'] = $_SESSION['customer'];
        }
        if ($cart_items_json != NULL) {
            $cart_items = json_decode($cart_items_json, TRUE);
            for ($i = 0; $i < count($cart_items); $i++) {
                $cart_items[$i]['item_data'] = $this->Itemmodel->get_item_by_id($cart_items[$i]['item'], '215x120');
            }
        }
        if (count($cart_items) > 0) {
            $data['preferences'] = $this->preferences;
            $data['cart_items'] = $cart_items;
            $data['taxes'] = $this->Search_model->get_taxes();
            Site::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Order Process', "");
            $data['main_content'] = 'site/order_process';
            $this->load->view('templates/site_template', $data);
        } else {
            redirect(base_url('error/page/716'));
        }
    }

    public function prescription_process() {
        $data['id_types'] = $this->Common->get_enum_values('customer', 'gov_id_type');
        $cart_items_json = get_cookie('shopping_cart');
        $cart_items = [];
        if (isset($_SESSION['customer'])) {
            $data['customer'] = $_SESSION['customer'];
        }
        if ($cart_items_json != NULL) {
            $cart_items = json_decode($cart_items_json, TRUE);
            for ($i = 0; $i < count($cart_items); $i++) {
                $cart_items[$i]['item_data'] = $this->Itemmodel->get_item_by_id($cart_items[$i]['item'], '215x120');
            }
        }
        if (count($cart_items) > 0) {
            $data['preferences'] = $this->preferences;
            $data['cart_items'] = $cart_items;
            $data['taxes'] = $this->Search_model->get_taxes();
            Site::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Prescription Process', "");
            $data['main_content'] = 'site/prescription_process';
            $this->load->view('templates/site_template', $data);
        } else {
            redirect(base_url('error/page/716'));
        }
    }

    public function signup_customer() {
        $error_no = 0;
        $error = '';
        $email = $this->input->post('email');
        if (!$this->Customer_model->is_customer_existing($email)) {
            $f_name = $this->input->post('f-name');
            $l_name = $this->input->post('l-name');
            $gov_id = $this->input->post('gov-id');
            $gov_id_type = $this->input->post('gov-id-type');
            $address = $this->input->post('address');
            $city = $this->input->post('city');
            $country = $this->input->post('country');
            $password = $this->input->post('password');
            $land_phone = $this->input->post('land-phone');
            $mobile_phone = $this->input->post('mobile-phone');
            $res = $this->Customer_model->create_customer($f_name, $l_name, $gov_id, $gov_id_type, $address, $city, $country, $email, $password, $land_phone, $mobile_phone);
            if (!$res) {
                $error_no = 750;
            } else {
                $customer = $this->db->get_where('customer', ['id' => $this->db->insert_id()])->result_array();
                if (count($customer) > 0) {
                    $this->Customer_model->send_welcome_email($customer[0]);
                    Site::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Customer Signup', $customer[0]['id']);
                }
            }
        } else {
            $error_no = 757;
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function signin_customer() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $res = $this->Customer_model->check_customer($username, $password);
        if ($res['result'] == TRUE) {
            $_SESSION['customer'] = $res['data'];
            Site::AddAuditTrailEntry(AUDITTRAIL_LOGIN, 'Customer', "Customer ID:" . $res['data']['id']);
        }
        header('Content-Type: application/json');
        echo json_encode(['result' => $res['result']]);
    }

    public function signout_customer() {
        unset($_SESSION['customer']);
        Site::AddAuditTrailEntry(AUDITTRAIL_LOGOUT, 'Customer', "");
    }

    public function check_email_existing() {
        $email = $this->input->get('email');
        $res = $this->Customer_model->is_customer_existing($email);
        header('Content-Type: application/json');
        echo json_encode(['exist' => $res]);
    }

    public function flip_enable_shopping_cart_item($item_id = NULL) {
        if ($item_id != NULL && $item_id > 0) {
            $cart_data_json = get_cookie('shopping_cart');
            if ($cart_data_json != NULL) {
                $cart_data = json_decode($cart_data_json, TRUE);
                for ($i = 0; $i < count($cart_data); $i++) {
                    if ($cart_data[$i]['item'] == $item_id) {
                        $cart_data[$i]['enabled'] = !$cart_data[$i]['enabled'];
                    }
                }
                set_cookie('shopping_cart', json_encode($cart_data), "345600");
                Site::AddAuditTrailEntry(AUDITTRAIL_UPDATE, 'Cart Item', "");
            }
        }
        echo "OK";
    }

    public function order() {
        $error_no = 0;
        $error = '';
        $order_id = NULL;
        //create order record with items and texts
        if (isset($_SESSION['customer'])) {
            $customer = $_SESSION['customer'];
            $cart_items = $this->Search_model->get_shopping_cart_data();
            if (count($cart_items) > 0) {

                $res = $this->Order_model->create_order($cart_items, $this->preferences['APPLY_TAX_ONLINE_SALES'] == 1, $customer['id']);
                if ($res['success']) {
                    unset($_SESSION["shipping_address_id"]);
                    $recent_order = $this->db->from('order')->where('enabled', 1)
                                    ->order_by('id', 'desc')->limit(1)->get()->result_array();
                    //save prescription
                    if ($res['order_id'] != NULL) {
                        if (isset($_SESSION["prescription_session"])) {
                            $add_prescription = $this->Order_model->add_prescription($res['order_id']);
                            if ($add_prescription) {
                                unset($_SESSION["prescription_session"]);
                            }
                        }
                    }
                    $recent_invoice = $this->db->from('order_invoice')->where('enabled', 1)
                                    ->order_by('id', 'desc')->limit(1)->get()->result_array();
                    // Invoice_mail
                    if (count($recent_invoice) > 0) {
                        $invoice_details = $this->Invoice_model->get_invoice_details_by_id($recent_invoice[0]['id']);
                        if (!empty($invoice_details['customer'])) {
                            $customer_mail = $invoice_details['customer']['email'];
                            if ($customer_mail != "" && isset($customer_mail)) {
                                $subject = 'Customer Invoice ';
                                $template = $this->Common->get_template_by_id(CUSTOMER_INVOICE_MAIL_TEMPLATE);
                                if (!empty($template)) {
                                    $email_content = $template['content'];
                                    $mail_info = array(
                                        'first_name' => $invoice_details['customer']['first_name'],
                                        'last_name' => $invoice_details['customer']['last_name'],
                                        'order_number' => $invoice_details['order_number'],
                                        'order_date' => $invoice_details['order_date'],
                                        'invoice_code' => $invoice_details['invoice_code'],
                                        'amount' => $invoice_details['amount'],
                                        'invoice_card' => base_url('invoice/invoice_card/') . $invoice_details['key']
                                    );
                                    $mail = $this->Common->easy_mail($customer_mail, $subject, $mail_info, $email_content);
                                }
                            }
                        }
                    }
                    //send order email
                    if (count($recent_order) > 0) {
                        $invoice_details = $this->Invoice_model->get_invoice_details_by_id($recent_invoice[0]['id']);
                        if (!empty($invoice_details['customer'])) {
                            $customer_mail = $invoice_details['customer']['email'];
                            if ($customer_mail != "" && isset($customer_mail)) {
                                $subject = 'Customer Order - ORD / '.$invoice_details['order_number'];
                                $template = $this->Common->get_template_by_id(CUSTOMER_ORDER_MAIL_TEMPLATE);
                                if (!empty($template)) {
                                    $email_content = $template['content'];
                                    $mail_info = array(
                                        'first_name' => $invoice_details['customer']['first_name'],
                                        'last_name' => $invoice_details['customer']['last_name'],
                                        'order_number' => $invoice_details['order_number'],
                                        'order_date' => $invoice_details['order_date'],
                                        'invoice_code' => $invoice_details['invoice_code'],
                                        'amount' => $invoice_details['amount'],
                                        'order_card' => base_url('order/order_card/') . $invoice_details['order_key']
                                    );
                                    $mail2 = $this->Common->easy_mail($customer_mail, $subject, $mail_info, $email_content);
                                }
                            }
                        }
                        $order = $this->Order_model->get_order_by_id($recent_order[0]['id']);
                        //$this->Order_model->send_order_email($order, $this->preferences['ORDER_PREFIX']);
                        $_SESSION['order'] = $order;
                        Site::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Order', "Order ID:" . $order['id']);
                    } else {
                        $error_no = 715;
                    }
                } else {
                    $error_no = 715;
                }
            } else {
                $error_no = 711;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no == 0) {
            //redirect accordingly
            $after_order_url = $this->Order_model->get_after_order_url($this->preferences);
            redirect(base_url('site'));
        } else {
            //or show error
            redirect(base_url('error/page/' . $error_no));
        }
    }

    public function shipping_data($profile_id = NULL) {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['customer'])) {
            $cart_items_json = get_cookie('shopping_cart');
            $cart_items = [];
            if ($cart_items_json != NULL) {
                $cart_items = json_decode($cart_items_json, TRUE);
                for ($i = 0; $i < count($cart_items); $i++) {
                    $cart_items[$i]['item_data'] = $this->Itemmodel->get_item_by_id($cart_items[$i]['item'], '215x120');
                }
            }
            if (count($cart_items) > 0) {
                //if (isset($_SESSION['order'])) {
                //$order = $_SESSION['order'];
                //if (count($order) > 0) {
                Site::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Shipping Details', "");
                //$data['order'] = $order;
                $shipping_profiles = $this->Order_model->get_addesses('CUSTOMER', $_SESSION['customer']['id'], 1);
                $selected_profile = NULL;
                if (count($shipping_profiles) > 0) {
                    if ($profile_id > 0) {
                        foreach ($shipping_profiles as $profile) {
                            if ($profile['id'] == $profile_id) {
                                $selected_profile = $profile;
                                break;
                            }
                        }
                    } else {
                        $selected_profile = $shipping_profiles[0];
                    }
                }
                $data['selected_profile'] = $selected_profile;
                $data['shipping_profiles'] = $shipping_profiles;
                $data['main_content'] = 'site/shipping_details';
                $this->load->view('templates/site_template', $data);
//                } else {
//                    $error_no = 714;
//                }
//            } else {
//                $error_no = 713;
//            }
            } else {
                $error_no = 711;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            redirect(base_url('error/page/' . $error_no));
        }
    }

    public function order_confirmation() {
        $error_no = 0;
        $error = '';
        if (isset($_SESSION['customer'])) {
            $cart_items_json = get_cookie('shopping_cart');
            $cart_items = [];
            if ($cart_items_json != NULL) {
                $cart_items = json_decode($cart_items_json, TRUE);
                for ($i = 0; $i < count($cart_items); $i++) {
                    $cart_items[$i]['item_data'] = $this->Itemmodel->get_item_by_id($cart_items[$i]['item'], '215x120');
                }
            }
            if (count($cart_items) > 0) {
                $shipping_address_id = $this->uri->segment(3);
                Site::AddAuditTrailEntry(AUDITTRAIL_VIEW, 'Order Confirmation', "");
                $shipping_profiles = $this->Customer_model->get_shipping_address_by_id($shipping_address_id);
                $data['cart_items'] = $cart_items;
                $data['selected_profile'] = $shipping_profiles;
                $data['preferences'] = $this->preferences;
                $data['taxes'] = $this->Search_model->get_taxes();
                if (!empty($_SESSION['prescription_session'])) {
                    $data['prescription_details'] = $_SESSION['prescription_session'];
                }

                $data['main_content'] = 'site/order_confirmation';
                $this->load->view('templates/site_template', $data);
            } else {
                $error_no = 711;
            }
        } else {
            $error_no = 1;
        }
        if ($error_no > 0) {
            redirect(base_url('error/page/' . $error_no));
        }
    }

    public function add_shipping_profile() {
        $error_no = 0;
        $error = '';
        $customer_id = $this->input->post('customer-id');
        $title = $this->input->post('title');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $country = $this->input->post('country');
        $zip_code = $this->input->post('zip');
        $contact_number = $this->input->post('contact-number');
        $res = $this->Customer_model->create_shipping_address($customer_id, $title, $address, $city, $state, $country, $zip_code, $contact_number);
        if (!$res) {
            $error_no = 750;
        } else {
            Site::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Shipping Profile', $customer_id);
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function update_shipping_profile() {
        $error_no = 0;
        $error = '';
        $profile_id = $this->input->post('profile-id');
        $customer_id = $this->input->post('customer-id');
        $title = $this->input->post('title');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $country = $this->input->post('country');
        $zip_code = $this->input->post('zip');
        $contact_number = $this->input->post('contact-number');
        $res = $this->Customer_model->update_shipping_address($profile_id, $customer_id, $title, $address, $city, $state, $country, $zip_code, $contact_number);
        if (!$res) {
            $error_no = 750;
        } else {
            Site::AddAuditTrailEntry(AUDITTRAIL_ADDNEW, 'Shipping Profile', $customer_id);
        }
        if ($error_no > 0) {
            $error = $this->config->item($error_no, 'msg');
        }
        header('Content-Type: application/json');
        echo json_encode(array('error_no' => $error_no, 'error' => $error));
    }

    public function prescription($order_id) {
        $data['main_content'] = 'site/prescription';
        $this->load->view('templates/site_template', $data);
    }

    public function set_shipping_address() {
        if ($_POST['shipping_address_id']) {
            $shipping_address_id = $this->input->post('shipping_address_id');
            if (isset($_SESSION['shipping_address_id'])) {
                unset($_SESSION['shipping_address_id']);
            }
            $_SESSION['shipping_address_id'] = $shipping_address_id;
        }
    }

}
