<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Activities_model extends CI_Model {
    
    public function get_activities() {
        $this->db->select('tbl_activities.*,tbl_users.name_user,tbl_orders_type.name_category,tbl_state.name_state');            
        $this->db->from('tbl_activities');
        $this->db->join('tbl_users', 'tbl_activities.idUser = tbl_users.id');
        $this->db->join('tbl_orders_type', 'tbl_activities.idOrderCategory = tbl_orders_type.id');
        $this->db->join('tbl_state', 'tbl_activities.idState = tbl_state.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    public function get_activitie($id) {
        $query = $this->db->get_where('tbl_activities', array('id'=>$id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    
    public function get_activities_xtype($type) {
        $query = $this->db->get_where('tbl_activities', array('idOrderCategory' => $type));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    public function add_activitie($data) {
        $this->db->insert('tbl_activities', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function edit_activitie($id_activitie, $data) {
        $this->db->where('id', $id_activitie);
        $this->db->update('tbl_activities', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_activitie($id_activitie) {
        $this->db->where('id', $id_activitie);
        $this->db->delete('tbl_activities');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
