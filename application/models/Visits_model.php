<?php

/**
 * Description of Visits
 *
 * @author jhon
 */
class Visits_model extends CI_Model {

    public function get_orders_state2() {
        $sql = 'select tbl_orders.*,max(tbl_orders_details.idActivities),tbl_orders_details.idServices,
            tbl_activities.name_activitie,tbl_services.name_service from tbl_orders join tbl_orders_details
            on tbl_orders.id = tbl_orders_details.idOrder join tbl_activities on 
            tbl_orders_details.idActivities = tbl_activities.id join tbl_services on
            tbl_orders_details.idServices = tbl_services.id where tbl_orders.idArea=1 group by tbl_orders.id';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_orders_assign_technics() {
        $sql = 'select tbl_orders.*,tbl_users.name_user,max(tbl_orders_details.idActivities),tbl_orders_details.idServices,
            tbl_orders_details.site,tbl_activities.name_activitie,tbl_services.name_service from tbl_orders join tbl_users
            on tbl_orders.idTechnicals = tbl_users.id join tbl_orders_details
            on tbl_orders.id = tbl_orders_details.idOrder join tbl_activities on 
            tbl_orders_details.idActivities = tbl_activities.id join tbl_services on
            tbl_orders_details.idServices = tbl_services.id where tbl_orders.idArea=2 group by tbl_orders.id';      
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function assign_order_technic($idOrder, $data) {
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function return_order_register($idOrder, $data) {
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
