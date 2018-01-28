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
    
    public function get_pl1() {
        $sql = 'select tbl_orders.*,max(tbl_orders_details.idActivities),tbl_orders_details.idServices,tbl_orders_details.count,tbl_orders_details.site,
            tbl_activities.name_activitie,tbl_services.name_service,tbl_users.name_user from tbl_orders join tbl_orders_details
            on tbl_orders.id = tbl_orders_details.idOrder join tbl_activities on 
            tbl_orders_details.idActivities = tbl_activities.id join tbl_services on
            tbl_orders_details.idServices = tbl_services.id JOIN tbl_users on tbl_orders.idTechnicals=tbl_users.id where tbl_orders.idArea=3 and tbl_orders.idOrderState=9 group by tbl_orders.id';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
}
