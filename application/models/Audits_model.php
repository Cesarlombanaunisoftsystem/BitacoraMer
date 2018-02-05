<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Audits_model
 *
 * @author jhon
 */
class Audits_model extends CI_Model {
    
    public function get_pl($state) {
        $sql = 'select tbl_orders.*,max(tbl_orders_details.idActivities),tbl_orders_details.idServices,tbl_orders_details.count,tbl_orders_details.site,
            tbl_activities.name_activitie,tbl_services.name_service,tbl_users.name_user, sum(tbl_orders_pays.percent) as percent_pay from tbl_orders join tbl_orders_details
            on tbl_orders.id = tbl_orders_details.idOrder join tbl_activities on 
            tbl_orders_details.idActivities = tbl_activities.id join tbl_services on
            tbl_orders_details.idServices = tbl_services.id JOIN tbl_users on tbl_orders.idTechnicals=tbl_users.id JOIN tbl_orders_pays on tbl_orders.id=tbl_orders_pays.idOrder where tbl_orders.idArea=3 and tbl_orders.idOrderState='.$state.' group by tbl_orders.id';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    
    public function edit_detail($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tbl_orders_details', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
