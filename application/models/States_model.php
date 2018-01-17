<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of States_model
 *
 * @author jhon
 */
class States_model extends CI_Model{
    public function get_states() {
        $query = $this->db->get('tbl_state');
        if($query->num_rows() > 0){
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
}
