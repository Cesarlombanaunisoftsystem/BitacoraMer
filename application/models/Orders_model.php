<?php

class Orders_model extends CI_Model{

    public function get_order($id){
        $this->db->where('id', $id);
        $this->db->where('idArea', null);
        $this->db->where('idOrderState', null);
        $this->db->from('tbl_orders');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function get_orders_tray(){
        $this->db->select('tbl_orders.*,tbl_users.name_user');
        $this->db->from('tbl_orders');
        $this->db->join('tbl_users','tbl_orders.idCoordinatorExt=tbl_users.id');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_order_details($id){
        $this->db->select('tbl_orders_details.*,tbl_orders.idArea,tbl_activities.name_activitie,tbl_services.name_service');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_orders','tbl_orders_details.idOrder=tbl_orders.id');
        $this->db->join('tbl_activities','tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services','tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('tbl_orders_details.idOrder', $id);
        $this->db->where('tbl_orders.idArea', null);
        $this->db->where('tbl_orders.idOrderState', null);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function details_orders_tray($id){
        $this->db->select('tbl_orders_details.*,tbl_orders.idArea,tbl_activities.name_activitie,tbl_services.name_service');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_orders','tbl_orders_details.idOrder=tbl_orders.id');
        $this->db->join('tbl_activities','tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services','tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('tbl_orders_details.idOrder', $id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }
    }

    public function add_order($data){
        $this->db->insert('tbl_orders',$data);
        if($this->db->affected_rows()>0){
            return true;
        } else {
            return false;
        }
    }

    public function add_order_detail($data){
        $this->db->insert('tbl_orders_details',$data);
        if($this->db->affected_rows()>0){
            return true;
        } else {
            return false;
        }
    }

    public function remove_order_detail($id){
        $this->db->where('id', $id);
        $this->db->delete('tbl_orders_details');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function register_order($id,$data,$dataDoc1,$dataDoc2,$dataDoc3,$dataDoc4) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('tbl_orders', $data);
        $this->db->insert('tbl_orders_documents', $dataDoc1);
        $this->db->insert('tbl_orders_documents', $dataDoc2);
        $this->db->insert('tbl_orders_documents', $dataDoc3);
        $this->db->insert('tbl_orders_documents', $dataDoc4);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}