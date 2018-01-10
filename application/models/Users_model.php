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
class Users_model extends CI_Model {

    public function get_user($user) {
        $query = $this->db->get_where('tbl_users', array('email' => $user));
        if ($query->num_rows() != 0) {
            return $query->row();  //retorna 1 sola fila
        } else {
            return FALSE;
        }
    }

}
