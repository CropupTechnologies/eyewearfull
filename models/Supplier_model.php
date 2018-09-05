<?php

class Supplier_model extends MY_Model {

    public function add_supplier($info) {
        $date = date('Y-m-d H:i:s');
        $data = array(
            'name' => $info['name'],
            'email' => $info['email'],
            'phone' => $info['telephone'],
            'mobile' => $info['mobile'],
            'fax' => $info['fax'],
            'contact_person' => $info['contact_person'],
            'address' => $info['address'],
            'category' => $info['category'],
            'enabled' => 1,
            'created_by' => $_SESSION['admin']['id'],
            'created_on' => $date,
            'lastupdated_by' => $_SESSION['admin']['id'],
            'lastupdated_on' => $date,
        );

        $res = $this->db->insert('supplier', $data);
        return $res;
    }

    public function edit_supplier($info) {
        $date = date('Y-m-d H:i:s');
        $data = array(
            'name' => $info['name'],
            'email' => $info['email'],
            'phone' => $info['telephone'],
            'mobile' => $info['mobile'],
            'fax' => $info['fax'],
            'contact_person' => $info['contact_person'],
            'address' => $info['address'],
            'category' => $info['category'],
            'lastupdated_by' => $_SESSION['admin']['id'],
            'lastupdated_on' => $date,
        );
        $this->db->where('id', $info['id']);
        $res = $this->db->update('supplier', $data);
        return $res;
    }

    public function get_all_suppliers() {
        $this->db->select('sup.*, pt.type_name AS category_name');
        $this->db->from('supplier sup');
        $this->db->join('product_type pt', 'pt.id = sup.category', 'left');
        
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

}
