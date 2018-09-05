<?php

/*
 * Author : Mcinfas
 * Date : 2018/01/16
 */

class Category_model extends MY_Model {

    public function get_all_categories($enabled = NULL) {
        if($enabled != NULL){
            $this->db->where('enabled', $enabled);
        }
        $result = $this->db->get('category')->result_array();
        return $result;
    }

    public function get_parent_categories() {
        $query = $this->db->get_where('category', array('enabled' => 1, 'parent_category_id' => 0));
        $result = $query->result_array();
        return $result;
    }

    public function add_category($info) {
        $date = date('Y-m-d h:i:s');
        $data = array(
            'name' => $info['category_name'],
            'description' => $info['category_description'],
            'parent_category_id' => $info['main_category_id'],
            'enabled' => 1,
            'created_by' => $_SESSION['admin']['id'],
            'created_on' => $date,
            'lastupdated_by' => $_SESSION['admin']['id'],
            'lastupdated_on' => $date,
        );
        $res = $this->db->insert('category', $data);
        $y = $this->db->last_query();
        return $res;
    }

    public function get_nestable_view() {
        $query = $this->db->get_where('category', array('parent_category_id' => 0));
        $return = array();
        foreach ($query->result() as $category) {
            $return[$category->id] = $category;
            $return[$category->id]->subs = $this->get_sub_categories($category->id); // Get the categories sub categories
        }
        return $return;
    }

    public function get_sub_categories($category_id) {
        $this->db->where('parent_category_id', $category_id);
        $query = $this->db->get('category');
        return $query->result();
    }

    public function edit_category($info) {
        $date = date('Y-m-d h:i:s');
        $data = array(
            'name' => $info['category_name'],
            'description' => $info['category_description'],
            'lastupdated_on' => $date,
            'lastupdated_by' => $_SESSION['admin']['id'],
        );
        $this->db->where('id', $info['category_id']);
        $res = $this->db->update('category', $data);
        return $res;
    }

    public function get_category_tree() {
        $category_tree = [];
        $all_categories = $this->db
                        ->select('parent.id as parent_id,'
                                . 'parent.name as parent_name, '
                                . 'parent.description as parent_desc, '
                                . 'parent.enabled as parent_enabled, '
                                . 'sub.id as sub_id, '
                                . 'sub.name as sub_name, '
                                . 'sub.description as sub_desc, '
                                . 'sub.enabled as sub_enabled')
                        ->from('category parent')
                        ->join('category sub', 'sub.parent_category_id = parent.id', 'left')
                        ->where('parent.parent_category_id', 0)
                        ->get()->result_array();
        for ($i = 0; $i < count($all_categories); $i++) {
            $parent_id = $all_categories[$i]['parent_id'];
            if (empty($category_tree[$all_categories[$i]['parent_id']])) {
                $category_tree[$parent_id] = [
                    'parent_name' => $all_categories[$i]['parent_name'],
                    'parent_desc' => $all_categories[$i]['parent_desc'],
                    'parent_enabled' => $all_categories[$i]['parent_enabled'],
                    'sub_categories' => []
                ];
            }
            $category_tree[$parent_id]['sub_categories'][] = [
                'sub_id' => $all_categories[$i]['sub_id'],
                'sub_name' => $all_categories[$i]['sub_name'],
                'sub_desc' => $all_categories[$i]['sub_desc'],
                'sub_enabled' => $all_categories[$i]['sub_enabled']
            ];
        }
        return $category_tree;
    }

    public function get_category_by_subcategory($sub_category_id) {
        $sub_category = $this->get_category_by_id($sub_category_id);
        if ($sub_category != FALSE) {
            $parent_category = $this->get_category_by_id($sub_category['parent_category_id']);
            if($parent_category != FALSE){
                $parent_category['sub_category'] = $sub_category;
                return $parent_category;
            }
        }
        return FALSE;
    }

    public function get_category_by_id($category_id) {
        $res = $this->db->get_where('category', ['id' => $category_id])->result_array();
        if (count($res) > 0) {
            return $res[0];
        }
        return FALSE;
    }

}
