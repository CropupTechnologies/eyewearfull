<?php

class Color_model extends MY_Model {

    public function get_all_colors() {
        $this->db->select('id,name,color,shade,style,enabled');
        $this->db->from('colors');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function add_color($info) {
        $date = date('Y-m-d h:i:s');
        $data = array(
            'name' => $info['name'],
            'color' => $info['color'],
            'shade' => $info['shade'],
            'style' => $info['style'],
            'enabled' => 1,
            'created_by' => $_SESSION['admin']['id'],
            'created_on' => $date,
            'lastupdated_by' => $_SESSION['admin']['id'],
            'lastupdated_on' => $date,
        );

        $res = $this->db->insert('colors', $data);
        return $res;
    }

    public function edit_color($info) {
        $date = date('Y-m-d h:s:i');
        $user_id = $_SESSION['admin']['id'];
        $data = array(
            'name' => $info['name'],
            'color' => $info['color'],
            'shade' => $info['shade'],
            'style' => $info['style'],
            'lastupdated_by' => $user_id,
            'lastupdated_on' => $date,
        );
        $this->db->where('id', $info['id']);
        $res = $this->db->update('colors', $data);
        return $res;
    }

}
