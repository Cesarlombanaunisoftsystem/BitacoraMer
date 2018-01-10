<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login_model extends CI_Model {

    public function login_user($username, $password) {
        //$sql = "SELECT t1.*,t2.name as profile FROM tbl_users t1 JOIN tbl_users_profile t2 ON t2.id=t1.id"
        $this->db->select('tbl_users.*,tbl_users_profile.name as profile');    
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
