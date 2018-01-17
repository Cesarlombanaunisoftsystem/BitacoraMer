<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Services_model extends CI_Model {

    public function services() {
        $this->db->select('tbl_services.*,tbl_users.name_user,tbl_activities.name_activitie,tbl_taxes.name_tax,tbl_taxes.percent_tax,tbl_state.name_state');
        $this->db->from('tbl_services');
        $this->db->join('tbl_users', 'tbl_services.idUser=tbl_users.id');
        $this->db->join('tbl_activities', 'tbl_services.idActivitie=tbl_activities.id');
        $this->db->join('tbl_taxes', 'tbl_services.idTask=tbl_taxes.id');
        $this->db->join('tbl_state', 'tbl_services.idState=tbl_state.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_services($activiti) {
        $this->db->where('idActivitie', $activiti);
        $this->db->order_by('name_service', 'asc');
        $localidades = $this->db->get('tbl_services');
        if ($localidades->num_rows() > 0) {
            return $localidades->result();
        }
    }

    public function get_service($id) {
        $query = $this->db->get_where('tbl_services', array('id' => $id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function add_service($data) {
        $this->db->insert('tbl_services', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_service($id_service) {
        $this->db->where('id', $id_service);
        $this->db->delete('tbl_services');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit_service($id_service, $data) {
        $this->db->where('id', $id_service);
        $this->db->update('tbl_services', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
