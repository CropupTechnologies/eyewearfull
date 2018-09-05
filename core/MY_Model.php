<?php

/**
 * User: Sampath Abeysinghe
 * Date: 08/01/2018
 */
class MY_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

//    public function AddAuditTrailEntry($action, $entity, $note) {
//        /**
//         * Add Items for audit trail
//         * table fields
//         * id int auto increment
//         * user varchar (40)
//         * action tinyint
//         * entity tinyint
//         * note text
//         * datetime datetime
//         */
//        $data = array(
//            'user' => $this->session->userdata('user_name') != '' ? $this->session->userdata('user_name') : 'Guest',
//            'action' => !empty($action) ? $action : '',
//            'entity' => !empty($entity) ? $entity : '',
//            'note' => !empty($note) ? $note : '',
//            'datetime' => gmdate("Y-m-d H:i:s")
//        );
//
//        $this->db->insert('audittrail', $data);
//    }

    public static function AddAuditTrailEntry($action, $entity, $note) {
        $CI = & get_instance();
        $username = 'Guest';
        if (isset($_SESSION['admin'])) {
            $username = $_SESSION['admin']['name'];
        }
        $data = array(
            'user' => $username,
            'action' => !empty($action) ? $action : '',
            'entity' => !empty($entity) ? $entity : '',
            'note' => !empty($note) ? $note : '',
            'datetime' => gmdate("Y-m-d H:i:s")
        );

        $CI->db->insert('audittrail', $data);
    }

}
