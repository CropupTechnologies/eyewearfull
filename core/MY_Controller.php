<?php
/**
 * User: Buddhika Dombawela
 * Date: 11/29/13    Time: 10:14 AM
 */
class MY_Controller extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function userAgentDetails() {
        if ($this->agent->is_browser()) {
            return $this->agent->browser() . ' ' . $this->agent->version() . ' | ' . $this->agent->platform();
        } elseif ($this->agent->is_robot()) {
            return $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            return $this->agent->mobile();
        } else {
            return 'Unidentified User Agent';
        }
    }

    public function dateValidate($date) {
        $date_regex = '/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/';
        if (!preg_match($date_regex, $date)) {
            return false;
        } else {
            return true;
        }
    }

    public function calculateAge($date) {
        //date_default_timezone_set('America/New_York');
        $datetime1 = strtotime(convertServerToLocal(date("Y-m-d H:i:s"), SERVER_TIME_ZONE, LOCAL_TIME_ZONE));
        $datetime2 = strtotime(convertGmtToLocal($date, LOCAL_TIME_ZONE));
        $interval = abs($datetime1 - $datetime2);

        if ($interval < 60) {
            $seconds = $interval;
            $end = ' Just now';
            return $end;
        } elseif ($interval < 3600) {
            $minutes = round($interval / 60);
            if ($minutes == 1) {
                $end = ' Minute ago';
            } else {
                $end = ' Minutes ago';
            }
            return $minutes . $end;
        } elseif ($interval < 3600 * 24) {
            $hours = round($interval / (60 * 60));
            if ($hours == 1) {
                $end = ' Hour ago';
            } else {
                $end = ' Hours ago';
            }
            return $hours . $end;
        } elseif ($interval < 3600 * 24 * 30) {
            $day = round($interval / (60 * 60 * 24));
            if ($day == 1) {
                $end = ' Day ago';
            } else {
                $end = ' Days ago';
            }
            return $day . $end;
        } elseif ($interval < 3600 * 24 * 365) {
            $month = round($interval / (60 * 60 * 24 * 30));
            if ($month == 1) {
                $end = ' Month ago';
            } else {
                $end = ' Month ago';
            }
            return $month . $end;
        } elseif ($interval > 3600 * 24 * 365) {
            $year = round($interval / (60 * 60 * 24 * 365));
            if ($year == 1) {
                $end = ' Year ago';
            } else {
                $end = ' Years ago';
            }
            return $year . $end;
        }
    }

    public function isAdmin() {
        $ROLE_ADMIN = 1;
        if ($this->session->userdata('roles')) {
            if (in_array($ROLE_ADMIN, $this->session->userdata('roles'))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isLogonUser($user) {
        if ($this->session->userdata('user_id')) {
            if ($this->session->userdata('user_id') == $user) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isTempUser() {
        if ($this->session->userdata('temp_user_id')) {
            return true;
        } else {
            return false;
        }
    }

    public function unsetTempUser() {
        $this->session->unset_userdata('temp_user_id');
        return true;
    }

    public function setTempUser() {
        $this->session->set_userdata(array('temp_user_id' => true));
        return true;
    }

    public static function AddAuditTrailEntry($action, $entity, $note) {
        $CI = & get_instance();
        $username = 'Guest';
        if(isset($_SESSION['admin'])){
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
