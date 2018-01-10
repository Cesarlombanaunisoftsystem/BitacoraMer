<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Activities_model extends CI_Model {

    public function get_activities_bts() {
        $this->db->where('idOrderCategory', 1);
        $query = $this->db->get('tbl_activities');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
}