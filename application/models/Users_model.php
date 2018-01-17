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

    public function get_user_xid($id) {
        $this->db->select('tbl_users.*,tbl_users_profile.name_profile');
        $this->db->from('tbl_users');
        $this->db->join('tbl_users_profile', 'tbl_users.idUserProfile = tbl_users_profile.id');
        $this->db->where('tbl_users.id', $id);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->row();  //retorna 1 sola fila
        } else {
            return FALSE;
        }
    }

    public function get_user($user) {
        $query = $this->db->get_where('tbl_users', array('email' => $user));
        if ($query->num_rows() != 0) {
            return $query->row();  //retorna 1 sola fila
        } else {
            return FALSE;
        }
    }

    public function add_user($data) {
        $sql = $this->db->get_where('tbl_users', array('email' => $data['email']));
        if ($sql->num_rows() > 0) {
            return 'error';
        } else {
            $this->db->insert('tbl_users', $data);
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function delete_user($id_user) {
        $this->db->where('id', $id_user);
        $this->db->delete('tbl_users');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit_user($id_user, $data) {
        $this->db->where('id', $id_user);
        $this->db->update('tbl_users', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_roles() {
        $query = $this->db->get('tbl_users_profile');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_user_permits($id_user) {
        $this->db->select('tbl_permits.*,tbl_permits_assign.*');
        $this->db->from('tbl_permits');
        $this->db->join('tbl_permits_assign', 'tbl_permits.id = tbl_permits_assign.id_permit');
        $this->db->where('tbl_permits_assign.id_user_assign_permit', $id_user);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_users() {
        $this->db->select('tbl_users.*,tbl_users_profile.name_profile');
        $this->db->from('tbl_users');
        $this->db->join('tbl_users_profile', 'tbl_users.idUserProfile = tbl_users_profile.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function add_permit($id_permit, $id_user_assign) {
        $data = array(
            'id_permit' => $id_permit,
            'id_user_assign_permit' => $id_user_assign,
            'created_at' => date('Y-m-d')
        );
        $this->db->insert('tbl_permits_assign', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function remove_permit($id_permit, $id_user_assign) {
        $this->db->delete('tbl_permits_assign', array('id_permit' => $id_permit, 'id_user_assign_permit' => $id_user_assign));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
