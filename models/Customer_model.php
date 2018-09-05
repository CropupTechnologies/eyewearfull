<?php

class Customer_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common');
    }

    public function create_customer($f_name, $l_name, $gov_id, $gov_id_type, $address, $city, $country, $email, $password, $land_phone, $mobile_phone) {
        $data = [
            'first_name' => $f_name,
            'last_name' => $l_name,
            'gov_id' => $gov_id,
            'gov_id_type' => $gov_id_type,
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'land_phone' => $land_phone,
            'mobile_phone' => $mobile_phone,
            'enabled' => 1,
            'created_by' => 0,
            'created_on' => date('Y/m/d h:i:s'),
            'lastupdated_by' => 0,
            'lastupdated_on' => date('Y/m/d h:i:s'),
        ];
        return $this->db->insert('customer', $data);
    }

    public function check_customer($username, $password) {
        $data = $this->db->get_where('customer', ['enabled' => 1, 'email' => $username])->result_array();
        $res = FALSE;
        if (count($data) > 0) {
            $res = password_verify($password, $data[0]['password']);
            if ($res) {
                return ['result' => TRUE, 'data' => $data[0]];
            }
        }
        return ['result' => $res];
    }

    public function send_welcome_email($customer) {
        $this->Common->easy_mail($customer['email'], 'Welcome to Eyewear', [], 'Welcome to Eyewear');
    }

    public function is_customer_existing($email) {
        $res = $this->db->get_where('customer', ['email' => $email])->result_array();
        return count($res) > 0;
    }

    public function create_shipping_address($customer_id, $title, $address, $city, $state, $country, $zip_code, $contact_number) {
        $data = [
            'reference_id' => $customer_id,
            'entity' => 'CUSTOMER',
            'address_type' => 'SHIPPING',
            'profile_name' => $title,
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'state' => $state,
            'zip_code' => $zip_code,
            'contact_number' => $contact_number,
            'enabled' => 1,
            'created_by' => $customer_id,
            'created_on' => date('Y/m/d h:i:s'),
            'lastupdated_by' => $customer_id,
            'lastupdated_on' => date('Y/m/d h:i:s'),
        ];
        return $this->db->insert('address', $data);
    }

    public function update_shipping_address($profile_id, $customer_id, $title, $address, $city, $state, $country, $zip_code, $contact_number) {
        $data = [
            'profile_name' => $title,
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'state' => $state,
            'zip_code' => $zip_code,
            'contact_number' => $contact_number,
            'lastupdated_by' => $customer_id,
            'lastupdated_on' => date('Y/m/d h:i:s'),
        ];
        $this->db->where('id', $profile_id);
        return $this->db->update('address', $data);
    }

    public function get_customer_by_id($customer_id) {
        $customer = $this->db->get_where('customer', ['id' => $customer_id])
                ->result_array();
        if (count($customer) > 0) {
            return $customer[0];
        }
        return FALSE;
    }

    public function get_shipping_address_by_id($id) {
        $this->db->select('ad.*,cus.first_name,cus.last_name');
        $this->db->from('address ad');
        $this->db->join('customer cus', 'cus.id = ad.reference_id', 'inner');
        $this->db->where('ad.id', $id);
        $q = $this->db->get();
        $res = $q->result_array();
        if (!empty($res)) {
            return $res[0];
        } else {
            return FALSE;
        }
    }

}
