<?php

class Promotion_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Common');
    }

    public function get_all_promotions($admin = null) {
        $this->db->select('*');
        $this->db->from('promotion');
        if ($admin == null) {
            $this->db->where(array('enabled' => 1));
        }
        $q = $this->db->get();
        $res = $q->result_array();
        return $res;
    }

    public function add_promotion_items($info) {
        $creation_data = $this->Common->get_admin_creation_data();
        $res = $this->db->insert('promotion_items', array_merge($info, $creation_data));
        return $res;
    }

    public function add_promotion($info) {
        $creation_data = $this->Common->get_admin_creation_data();
        $res = $this->db->insert('promotion', array_merge($info, $creation_data));
        return $res;
    }

    public function edit_promotion($info) {
        $this->db->where('id', $info['id']);
        $res = $this->db->update('promotion', $info);
        return $res;
    }

}
