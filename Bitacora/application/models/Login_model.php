<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login_model extends CI_Model {

    public function login_user($username, $password) {        
        $this->db->select('tbl_users.*,tbl_users_profile.name_profile');    
        $this->db->from('tbl_users');
        $this->db->join('tbl_users_profile', 'tbl_users.idUserProfile = tbl_users_profile.id');
        $this->db->where('tbl_users.email', $username);
        $this->db->where('tbl_users.password', $password);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            $this->session->set_flashdata('usuario_incorrecto', 'Los datos introducidos son incorrectos');
            redirect(base_url() . 'login', 'refresh');
        }
    }
}
