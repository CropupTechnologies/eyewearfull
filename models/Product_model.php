<?php

class Product_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_metadata_products($enabled = NULL) {
        $res = array();
        if ($enabled != NULL && ($enabled == 0 || $enabled == 1)) {
            $this->db->where('p.enabled', $enabled);
        }
        $res = $this->db
                        ->select('p.*, pt.type_name, usr.name as lastupdated_user')
                        ->from('metadata_product p')
                        ->join('product_type pt', 'p.product_type = pt.id')
                        ->join('sed_sys_user usr', 'p.lastupdated_by = usr.id')
                        ->get()->result_array();
        $q = $this->db->last_query();
        return $res;
    }

    public function get_all_product_types($enabled = NULL) {
        $res = array();
        if ($enabled != NULL && ($enabled == 0 || $enabled == 1)) {
            $this->db->where('pt.enabled', $enabled);
        }
        $res = $this->db->get('product_type pt')->result_array();
        return $res;
    }

    public function get_product_by_id($id) {
        $res = $this->db
                        ->where('id', $id)
                        ->get('metadata_product')->result_array();
        if (count($res) > 0) {
            return $res[0];
        }
        return FALSE;
    }

    public function get_fields_by_product($product_id) {
        $res = $this->db
                        ->select('f.*, pf.id as product_field_id, pf.enabled as pf_enabled')
                        ->from('field f')
                        ->join('product_field pf', 'pf.field_id = f.id')
                        ->where('pf.product_id', $product_id)
                        ->order_by('pf.display_index')
                        ->get()->result_array();
        if (count($res) > 0) {
            for ($i = 0; $i < count($res); $i++) {
                $res[$i]['values'] = $this->Common->get_field_values_by_id($res[$i]['id']);
            }
        }
        return $res;
    }

    public function add_product($name, $type, $counting_behaviour, $description, $created_by) {
        $date = date('Y-m-d H:i:s');
        $res = $this->db->insert('metadata_product', [
            'name' => $name,
            'description' => $description,
            'counting_behaviour' => $counting_behaviour,
            'product_type' => $type,
            'enabled' => 1,
            'created_by' => $created_by,
            'created_on' => $date,
            'lastupdated_by' => $created_by,
            'lastupdated_on' => $date,
        ]);
        if ($res) {
            return $this->db->insert_id();
        }
        return FALSE;
    }

    public function update_product($id, $name, $type, $counting_behaviour, $description, $created_by) {
        $date = date('Y-m-d H:i:s');
        $id = $this->db->where('id', $id);
        $res = $this->db->update('metadata_product', [
            'name' => $name,
            'description' => $description,
            'counting_behaviour' => $counting_behaviour,
            'product_type' => $type,
            'enabled' => 1,
            'lastupdated_by' => $created_by,
            'lastupdated_on' => $date,
        ]);
        if ($res) {
            return $this->db->affected_rows();
        }
        return FALSE;
    }

    public function add_product_fields($product_id, $selected_fields, $created_by) {
        $ok = TRUE;
        $date = date('Y-m-d H:i:s');
        $display_index = 0;
        foreach ($selected_fields as $field_id) {
            $res = $this->db->insert('product_field', array(
                'product_id' => $product_id,
                'field_id' => $field_id,
                'display_index' => ++$display_index,
                'enabled' => 1,
                'created_by' => $created_by,
                'created_on' => $date,
                'lastupdated_by' => $created_by,
                'lastupdated_on' => $date
            ));
            if (!$res) {
                $ok = FALSE;
                break;
            }
        }
        if ($ok) {
            return TRUE;
        }
        return FALSE;
    }

    public function adjust_dispay_index($is_increment, $product_field_id) {
        
    }

    private function increment_display_order($field_id) {
        
    }

    private function decrement_display_order($field_id) {
        
    }

    private function get_adjacent_field($is_previous, $product_field_id) {
        $previous = $current = $following = 0;
//        $res = 
    }

    public function get_all_suppliers($enabled = NULL) {
        if ($enabled != NULL) {
            $this->db->where('enabled', $enabled);
        }
        $res = $this->db->get_where('supplier')->result_array();
        return $res;
    }

    public function add_product_type($info) {
        $date = date('Y-m-d H:i:s');
        $data = array(
            'type_name' => $info['name'],
            'enabled' => 1,
            'created_by' => $_SESSION['admin']['id'],
            'created_on' => $date,
            'lastupdated_by' => $_SESSION['admin']['id'],
            'lastupdated_on' => $date,
        );

        $res = $this->db->insert('product_type', $data);
        return $res;
    }

    public function edit_product_type($info) {
        $date = date('Y-m-d H:i:s');
        $data = array(
            'type_name' => $info['name'],
            'lastupdated_by' => $_SESSION['admin']['id'],
            'lastupdated_on' => $date,
        );
        $this->db->where('id', $info['id']);
        $res = $this->db->update('product_type', $data);
        return $res;
    }

    public function get_random_products() {
        $this->db->select('model.*,model_image.image_name');
        $this->db->from('model');
        $this->db->join('model_image','model_image.model_id = model.id','left');
        $this->db->order_by('rand()');
        $this->db->limit(15);
        $query = $this->db->get();
        $q = $this->db->last_query();
        return $query->result_array();
    }

}
