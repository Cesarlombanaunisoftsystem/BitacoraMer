<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Activities_model extends CI_Model {

    public function get_activities_bts() {
        $query = $this->db->get_where('tbl_activities', array('idOrderCategory'=>1));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

}
