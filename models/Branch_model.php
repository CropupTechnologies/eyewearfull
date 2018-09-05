<?php

class Branch_model extends MY_Model {

    public function add_branch($info) {
         $date = date('Y-m-d h:i:s');
        $data = array(
            'name' => $info['branch_name'],
            'address1' => $info['branch_address1'],
            'address2' => $info['branch_address2'],
            'city' => $info['branch_city'],
            'telephone' => $info['branch_telephone'],
            'email' => $info['branch_email'],
            'Latitude' => $info['branch_latitude'],
            'Longitude' => $info['branch_longitude'],
            'enabled' => 1,
            'created_by' => $_SESSION['admin']['id'],
            'created_on' => $date,
            'lastupdated_by' => $_SESSION['admin']['id'],
            'lastupdated_on' => $date,
        );

        $res = $this->db->insert('branch', $data);
        return $res;
    }

    public function get_all_branches($enabled = NULL) {
        if($enabled != NULL){
            $this->db->where('enabled', $enabled);
        }
        $result = $this->db->get('branch')->result_array();
        return $result;
    }

    public function edit_branch($id, $info) {
         $date = date('Y-m-d h:i:s');
        $data = array(
            'name' => $info['branch_name'],
            'address1' => $info['branch_address1'],
            'address2' => $info['branch_address2'],
            'city' => $info['branch_city'],
            'telephone' => $info['branch_telephone'],
            'email' => $info['branch_email'],
            'Latitude' => $info['branch_latitude'],
            'Longitude' => $info['branch_longitude'],
            'lastupdated_by' => $_SESSION['admin']['id'],
            'lastupdated_on' => $date,
        );
        $this->db->where('id', $id);
        $res = $this->db->update('branch', $data);
        return $res;
    }

}
