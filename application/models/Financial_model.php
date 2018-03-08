<?php

/**
 * Description of Financial_model
 *
 * @author JHON JAIRO VALDÉS ARISTIZABAL
 */
class Financial_model extends CI_Model {
    public function get_settlement($state) {
        $sql = "SELECT tbl_orders.*, pagos.percent_pay, pagos.sumValue,
            details.idActivities, details.count, details.site,
            details.totalOrder, details.totalCost, act.name_activitie,
            serv.name_service, tecn.id as idTech, tecn.name_user
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
    
    public function getVrSettlement($idOrder) {
        $sql = "select sum(total) as vrVenta, sum(total_cost) as vrCostos from"
                . " tbl_orders_details where idOrder = '$idOrder'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->row();
        } else {
            return FALSE;
        }
    }
}
