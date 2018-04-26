<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Token_model extends CI_Model {
    
    public function add_token($data) {
        $this->db->insert('tbl_token_user', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function get_user($token) {
        $this->db->select('*');
        $this->db->from('tbl_token_user');
        $this->db->like('tbl_token_user.token ',$token);
        $data  = $this->db->get();
        return $data->result();
    }
    
    
    public function get_orders($token){
        $this->db->select('tbl_orders.*');
        $this->db->from('tbl_token_user');
        $this->db->join('tbl_users','tbl_token_user.id_user = tbl_users.id');
        $this->db->join('tbl_orders','tbl_orders.idUser = tbl_users.id');
        $this->db->like('tbl_token_user.token ',$token);
        $this->db->where('tbl_orders.idArea', 1);
        $this->db->where('tbl_orders.idOrderState', 1);
        $data  = $this->db->get();
        return $data->result();
    }
    
    public function get_order_by_id($idOrder) {
        $sql = "SELECT tbl_orders.*,tbl_logs.obsvLog,min(tbl_orders_details.idActivities),tbl_orders_details.idServices,tbl_orders_details.site,tbl_orders_details.count,tbl_activities.name_activitie,tbl_services.name_service,tbl_areas.name_area FROM tbl_orders JOIN tbl_logs ON tbl_orders.id=tbl_logs.idOrder JOIN tbl_areas ON tbl_orders.idAreaSend=tbl_areas.id JOIN tbl_orders_details ON tbl_orders.id = tbl_orders_details.idOrder JOIN tbl_activities ON tbl_orders_details.idActivities = tbl_activities.id JOIN tbl_services ON tbl_orders_details.idServices = tbl_services.id WHERE tbl_orders.id=$idOrder";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
}
