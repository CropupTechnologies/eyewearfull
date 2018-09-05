<?php

class Payment_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Common');
    }

    public function get_payments_by_invoice_id($invoice_id) {
        $this->db->select('p.*,mop.name as mode_of_payment');
        $this->db->from('payment p');
        $this->db->join('mode_of_payment mop', 'mop.id = p.payment_method');
        $this->db->where('p.invoice_id', $invoice_id);
        $q = $this->db->get();
        $res = $q->result_array();
        return $res;
    }

    public function get_all_mode_of_payments() {
        $q = $this->db->get_where('mode_of_payment', array('enabled', 1));
        $res = $q->result_array();
        return $res;
    }

    public function get_mode_of_payment_fields($mode_of_payment_id) {
        $this->db->select('mopf.*,pf.name as field_name,pf.type as field_type,pf.field_name as field_id,pf.html_type,pf.id as mod_field_id');
        $this->db->from('mode_of_payment_fields mopf');
        $this->db->join('payment_field pf', 'pf.id = mopf.payment_field_id', 'inner');
        $this->db->order_by('mopf.`order`', 'asc');
        $this->db->where(array('mopf.mode_of_payment_id' => $mode_of_payment_id, 'mopf.enabled' => 1));
        $q = $this->db->get();
        $res = $q->result_array();
        if (!empty($res)) {
            //get fields as html content
            for ($x = 0; $x < count($res); $x++) {
                switch ($res[$x]['html_type']) {
                    case 'TEXT':
                        if ($res[$x]['is_optional'] == 0) {
                            $res[$x]['html_content'] = '<input type="' . $res[$x]['field_type'] . '" name="' . $res[$x]['field_id'] . '" id="' . $res[$x]['field_id'] . '" class="form-control" required="required"/>';
                        } else {
                            $res[$x]['html_content'] = '<input type="' . $res[$x]['field_type'] . '" name="' . $res[$x]['field_id'] . '" id="' . $res[$x]['field_id'] . '" class="form-control"/>';
                        }
                        break;
                    case 1:
                        echo "i equals 1";
                        break;
                    case 2:
                        echo "i equals 2";
                        break;
                }
            }
        }
        return $res;
    }

    public function create_payment($data) {
        $creation_data = $this->Common->get_admin_creation_data();
        $data['payment_reference'] = 'RCT/' . date('Y') . '/' . random_string('nozero', 6);
        $res = $this->db->insert('payment', array_merge($data, $creation_data));
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function add_payment_field_data($params) {
        $creation_data = $this->Common->get_admin_creation_data();
        foreach ($params as $param) {
            $data = array(
                'payment_id' => $param['payment_id'],
                'payment_field_id' => $param['payment_field_id'],
                'value' => $param['value'],
            );
            $res = $this->db->insert('payment_field_data', array_merge($data, $creation_data));
        }
        return $res;
    }

    public function get_all_payments($from = null, $to = null, $mod = null) {
        $var = $this->get_all_payments_query;
        if ($from != null && $to != null) {
            $var .= " AND (convert_tz(date(p.created_on),'@server_tz','@local_tz') BETWEEN '$from' AND '$to')";
            $var = str_replace('@server_tz', SERVER_TIME_ZONE, $var);
            $var = str_replace('@local_tz', LOCAL_TIME_ZONE, $var);
        }

        if ($mod != null) {
            if ($mod != 'null') {
                $var .= " AND p.payment_method = $mod";
            }
        }
        $q = $this->db->query($var);
        $x = $this->db->last_query();
        $res = $q->result_array();
        return $res;
    }

    //Querirs Variable
    private $get_all_payments_query = "SELECT 
    p.*,oi.invoice_code
FROM
    payment p
    inner join
    order_invoice oi on oi.id = p.invoice_id
WHERE
    p.enabled = 1";

}
