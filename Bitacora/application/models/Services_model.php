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
    
    public function get_all_services() {
        $query = $this->db->get('tbl_services');
        if ($query->num_rows() > 0) {
            return $query->result();
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
    
    public function get_folder_service($id) {
        $query = $this->db->get_where('tbl_folders_services', array('idServices' => $id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    
    public function get_services_order($idOrder) {
        $this->db->select('tbl_orders_details.*,tbl_services.name_service');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_services','tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('idOrder', $idOrder);
        $this->db->where('idActivities !=', 22);
        $this->db->where('idActivities !=', 34);
        $this->db->where('idActivities !=', 35);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
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
    
    public function register_path_tree($id, $data, $data1) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('tbl_services', $data);
        $this->db->insert('tbl_folders_services', $data1);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function update_path_tree($id, $data, $data1) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('tbl_services', $data);
        $this->db->where('idServices', $id);
        $this->db->update('tbl_folders_services', $data1);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function get_services_path($id) {
        $this->db->select('folder');
        $this->db->from('tbl_folders_services');
        $this->db->where('idServices', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

}
