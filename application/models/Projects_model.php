<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Projects_model
 *
 * @author jj
 */
class Projects_model extends CI_Model{
    
    public function get_daily_management($state) {
        $sql = "SELECT tbl_orders.*, pagos.percent_pay, pagos.sumValue,
            details.idActivities, details.count, details.site,
            details.totalOrder, details.totalCost, act.name_activitie,
            serv.name_service, tecn.name_user, daily.gestion
    FROM tbl_orders
   LEFT JOIN (SELECT idOrder, min(idActivities) idActivities, min(idServices)
   idServices, count, site, sum(total) totalOrder, sum(cost) totalCost
   FROM tbl_orders_details
    GROUP BY idOrder) details
    ON tbl_orders.id = details.idOrder
    LEFT JOIN (SELECT id, name_activitie
   FROM tbl_activities
    GROUP BY id) act
    ON details.idActivities= act.id
    LEFT JOIN (SELECT id, name_service
   FROM tbl_services
    GROUP BY id) serv
    ON details.idServices= serv.id
    LEFT JOIN (SELECT id, name_user
   FROM tbl_users
    GROUP BY id) tecn
    ON tbl_orders.idTechnicals = tecn.id
    LEFT JOIN (SELECT idOrder, SUM(percent_execute) gestion
    FROM tbl_daily_management
    GROUP BY idOrder) daily
    ON tbl_orders.id = daily.idOrder
    LEFT JOIN (SELECT idOrder, SUM(percent) percent_pay, sum(value) sumValue
    FROM tbl_orders_pays
    GROUP BY idOrder) pagos
    ON tbl_orders.id = pagos.idOrder where tbl_orders.idArea = 3 AND tbl_orders.idOrderState = '$state'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    public function get_daily_management_order($idOrder) {
        $query = $this->db->get_where('tbl_daily_management',array('idOrder'=>$idOrder));
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    public function get_daily_management_xid($id) {
        $query = $this->db->get_where('tbl_daily_management',array('id'=>$id));
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    public function register_daily_management_order($data) {
            $this->db->insert('tbl_daily_management', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
