<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of Docs_model
 *
 * @author jhon
 */
class Docs_model extends CI_Model {

    public function register_docs() {
        $sql = "SELECT tbl_orders.*, pagos.percent_pay, pagos.sumValue,
            details.idActivities, details.count, details.site,
            details.totalOrder, details.totalCost, act.name_activitie,
            serv.name_service, tecn.name_user, daily.gestion,
            daily.id_type_management, typeGest.type, docs.gestiondoc
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
    ON tbl_orders.id = pagos.idOrder
    LEFT JOIN (SELECT idOrder, count(id) gestiondoc
   FROM tbl_orders_documents
    GROUP BY idOrder) docs
    ON tbl_orders.id = docs.idOrder
    where tbl_orders.idArea = 3 AND tbl_orders.idOrderState = 23";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function register_docs_process($id) {
        $sql = "SELECT tbl_logs.*,tbl_orders.*, pagos.percent_pay, pagos.sumValue,
            details.idActivities, details.count, details.site,
            details.totalOrder, details.totalCost, act.name_activitie,
            serv.name_service, tecn.name_user, daily.gestion,
            daily.id_type_management, typeGest.type, docs.gestiondoc
    FROM tbl_logs JOIN tbl_orders ON tbl_logs.idOrder = tbl_orders.id
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
    ON tbl_orders.id = pagos.idOrder
    LEFT JOIN (SELECT idOrder, count(id) gestiondoc
   FROM tbl_orders_documents
    GROUP BY idOrder) docs
    ON tbl_orders.id = docs.idOrder
    where tbl_logs.idProcessState = 17 AND tbl_logs.idUserProcess = '$id'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_docs() {
        $this->db->select('tbl_type_documents.*,tbl_state.name_state');
        $this->db->from('tbl_type_documents');
        $this->db->join('tbl_state', 'tbl_type_documents.idState=tbl_state.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_documents_order($idOrder) {
        $this->db->select('tbl_orders_documents.*,tbl_type_documents.name_type');
        $this->db->from('tbl_orders_documents');
        $this->db->join('tbl_type_documents', 'tbl_orders_documents.idTypeDocument=tbl_type_documents.id');
        $this->db->where('tbl_orders_documents.idOrder', $idOrder);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_doc($id) {
        $query = $this->db->get_where('tbl_type_documents', array('id' => $id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function add_doc($data) {
        $this->db->insert('tbl_type_documents', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit_doc($id_doc, $data) {
        $this->db->where('id', $id_doc);
        $this->db->update('tbl_type_documents', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_doc($id_doc) {
        $this->db->where('id', $id_doc);
        $this->db->delete('tbl_type_documents');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function docs_register() {
        $sql = 'select idOrder from tbl_orders_documents where idState=1';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

}
