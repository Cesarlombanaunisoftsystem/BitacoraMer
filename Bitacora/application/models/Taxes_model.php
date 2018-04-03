<?php

/**
 * Description of Taxes_model
 *
 * @author jhon
 */
class Taxes_model extends CI_Model{
    public function get_taxes() {
        $query = $this->db->get('tbl_taxes');
        if($query->num_rows() > 0){
            return $query->result();
        } else {
            return FALSE;
        }
    }
}
