<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users_model
 *
 * @author jhon
 */
class Permits_model extends CI_Model {

    public function get_permits() {
        $query = $this->db->get('tbl_permits');
        if ($query->num_rows() != 0) {
            return $query->result();  //retorna 1 sola fila
        } else {
            return FALSE;
        }
    }
}

