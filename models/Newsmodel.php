<?php

class newsmodel extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function add_news($news_title, $news_content, $news_expiry, $news_image, $created_by) {
        return $this->db->insert('news', array(
                    'title' => $news_title,
                    'content' => $news_content,
                    'expiry_date' => $news_expiry,
                    'image_name' => $news_image,
                    'enabled' => 1,
                    'created_by' => $created_by,
                    'created_on' => date('Y-m-d h:i:s'),
                    'lastupdated_by' => $created_by,
                    'lastupdated_on' => date('Y-m-d h:i:s'),
        ));
    }

    public function edit_news($news_id, $news_title, $news_content, $news_image, $news_expiry, $lastupdated_by) {
        $this->db->where('id', $news_id);
        $data = array(
            'title' => $news_title,
            'content' => $news_content,
            'expiry_date' => $news_expiry,
            'lastupdated_by' => $lastupdated_by,
            'lastupdated_on' => date('Y-m-d h:i:s'),
        );
        if($news_image != NULL && strlen(trim($news_image)) > 0){
            $data['image_name'] = trim($news_image);
        }
        return $this->db->update('news', $data);
    }

}
