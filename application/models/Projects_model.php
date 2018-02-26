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
class Projects_model extends CI_Model {

    public function get_daily_management($state) {
        $sql = "SELECT tbl_orders.*, pagos.percent_pay, pagos.sumValue,
            details.idActivities, details.count, details.site,
            details.totalOrder, details.totalCost, act.name_activitie,
            serv.name_service, tecn.name_user, daily.gestion,
            daily.id_type_management, typeGest.type
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
    LEFT JOIN (SELECT idOrder, MAX(id_type_management) id_type_management, MAX(percent_execute) gestion
    FROM tbl_daily_management
    GROUP BY idOrder) daily
    ON tbl_orders.id = daily.idOrder
    LEFT JOIN (SELECT id, type
    FROM tbl_type_management
    GROUP BY id) typeGest
    ON daily.id_type_management = typeGest.id
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
    
    public function get_daily_management_contract() {
        $sql = "SELECT tbl_orders.*, pagos.percent_pay, pagos.sumValue,
            details.idActivities, details.count, details.site,
            details.totalOrder, details.totalCost, act.name_activitie,
            serv.name_service, tecn.name_user, daily.gestion, typeGest.type
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
    LEFT JOIN (SELECT idOrder, id_type_management, MAX(percent_execute) gestion
    FROM tbl_daily_management
    GROUP BY idOrder) daily
    ON tbl_orders.id = daily.idOrder
    LEFT JOIN (SELECT id, type
    FROM tbl_type_management
    GROUP BY id) typeGest
    ON daily.id_type_management = typeGest.id
    LEFT JOIN (SELECT idOrder, SUM(percent) percent_pay, sum(value) sumValue
    FROM tbl_orders_pays
    GROUP BY idOrder) pagos
    ON tbl_orders.id = pagos.idOrder where tbl_orders.idArea = 3 AND tbl_orders.idOrderState > 17";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_daily_management_order($idOrder) {
        $this->db->select('tbl_daily_management.*,tbl_type_management.type');
        $this->db->from('tbl_daily_management');
        $this->db->join('tbl_type_management', 'tbl_daily_management.id_type_management=tbl_type_management.id');
        $this->db->where('tbl_daily_management.idOrder', $idOrder);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_accum_management($idOrder) {
        $sql = "SELECT id,percent_execute,percent_materials "
                . "FROM tbl_daily_management WHERE idOrder = '$idOrder' ORDER BY id DESC LIMIT 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function get_daily_management_xid($id) {
        $query = $this->db->get_where('tbl_daily_management', array('id' => $id));
        if ($query->num_rows() > 0) {
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

    public function closing_visit_request($data, $idOrder, $data1) {
        $this->db->trans_start();
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data1);
        $this->db->insert('tbl_daily_management', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_types_management() {
        $query = $this->db->get('tbl_type_management');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

}
