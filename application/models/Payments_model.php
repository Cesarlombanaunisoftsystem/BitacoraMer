<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payments_model
 *
 * @author jhon
 */
class Payments_model extends CI_Model {

    public function get_payments() {
        $query = $this->db->get('tbl_form_pays');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_pays_order($idOrder) {
        $this->db->select('*');
        $this->db->from("tbl_orders_pays_pay");
        $this->db->where("idOrder", $idOrder);
        $this->db->order_by("id", "asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_pays_box() {
        $sql = "SELECT tbl_orders.*, pagos.percent_pay, pagos.sumValue,
            pagos.state,details.idActivities, details.count, details.site,
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
    LEFT JOIN (SELECT idOrder, state, SUM(percent) percent_pay, sum(value) sumValue
    FROM tbl_orders_pays
    GROUP BY idOrder) pagos
    ON tbl_orders.id = pagos.idOrder WHERE tbl_orders.idOrderState > 11 AND
    tbl_orders.statePays = 0 AND (pagos.state = 0 || pagos.state is null)";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_pays($statePays) {
        $sql = "SELECT tbl_orders_pays.*,orders.uniquecode,orders.coi,
            orders.uniqueCodeCentralCost,orders.idTechnicals,details.idActivities, details.count, details.site,
            details.totalOrder, details.totalCost, act.name_activitie,
            serv.name_service, tecn.id as idTech, tecn.name_user
    FROM tbl_orders_pays
    LEFT JOIN (SELECT id, uniquecode,coi,uniqueCodeCentralCost,idTechnicals
   FROM tbl_orders
    GROUP BY id) orders
    ON tbl_orders_pays.idOrder = orders.id
   LEFT JOIN (SELECT idOrder, min(idActivities) idActivities, min(idServices)
   idServices, count, site, sum(total) totalOrder, sum(cost) totalCost
   FROM tbl_orders_details
    GROUP BY idOrder) details
    ON tbl_orders_pays.idOrder = details.idOrder
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
    ON orders.idTechnicals = tecn.id WHERE tbl_orders_pays.state = '$statePays'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_pays_process($state, $id) {
        $sql = "SELECT tbl_orders.*, pagos.percent_pay, pagos.sumValue, pagos.state,
            details.idActivities, details.count, details.site,
            details.totalOrder, details.totalCost, act.name_activitie,
            serv.name_service, tecn.id as idTech, tecn.name_user,
            paysdo.percentdo, paysdo.sumdo
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
    LEFT JOIN (SELECT idOrder,state, SUM(percent) percent_pay, sum(value) sumValue
    FROM tbl_orders_pays
    GROUP BY idOrder) pagos
    ON tbl_orders.id = pagos.idOrder
    LEFT JOIN (SELECT idOrder, SUM(percent) percentdo, sum(value) sumdo
    FROM tbl_orders_pays_pay
    GROUP BY idOrder) paysdo
    ON tbl_orders.id = paysdo.idOrder WHERE pagos.state>'$state' AND tbl_orders.idUserProcess = '$id'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_pays_xusers() {
        $sql = 'SELECT tbl_orders_pays_pay.*,orders.dateUpdate
    FROM tbl_orders_pays_pay
    LEFT JOIN (SELECT id,dateUpdate
   FROM tbl_orders) orders
    ON tbl_orders_pays_pay.idOrder = orders.id WHERE DATEDIFF(CURDATE(), orders.dateUpdate) = 0';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_pays_xuser($id) {
        $sql = "SELECT tbl_orders_pays_pay.*,orders.uniquecode,orders.uniqueCodeCentralCost,
            orders.idFormPay,details.idActivities,details.count, details.site,
            details.totalOrder, details.totalCost,act.name_activitie,serv.name_service,
            tecn.name_user,tecn.identify_number, tecn.address,tecn.phone,tecn.email,
            tecn.contact,pay.name_pay,bank.name_bank,account.number_account
    FROM tbl_orders_pays_pay
    LEFT JOIN (SELECT id,uniquecode,uniqueCodeCentralCost,idFormPay,dateUpdate
   FROM tbl_orders) orders
    ON tbl_orders_pays_pay.idOrder = orders.id
    LEFT JOIN (SELECT id,name_pay
   FROM tbl_form_pays) pay
    ON pay.id = orders.idFormPay
   LEFT JOIN (SELECT idOrder, min(idActivities) idActivities, min(idServices)
   idServices, count, site, sum(total) totalOrder, sum(total_cost) totalCost
   FROM tbl_orders_details
    GROUP BY idOrder) details
    ON orders.id = details.idOrder
    LEFT JOIN (SELECT id, name_activitie
   FROM tbl_activities
    GROUP BY id) act
    ON details.idActivities= act.id
    LEFT JOIN (SELECT id, name_service
   FROM tbl_services
    GROUP BY id) serv
    ON details.idServices= serv.id
    LEFT JOIN (SELECT id, idAccount, name_user, identify_number, address, phone,
    email, contact
   FROM tbl_users
    GROUP BY id) tecn
    ON tbl_orders_pays_pay.idTechnical = tecn.id
    LEFT JOIN (SELECT id,number_account,idBank
    FROM tbl_accounts) account
    ON account.id = tecn.idAccount
    LEFT JOIN (SELECT id,name_bank
    FROM tbl_banks) bank
    ON bank.id = account.idBank WHERE tbl_orders_pays_pay.idTechnical = '$id'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_pay($id) {
        $query = $this->db->get_where('tbl_form_pays', array('id' => $id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function add_pay($data) {
        $this->db->insert('tbl_form_pays', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit_pay($id_pay, $data) {
        $this->db->where('id', $id_pay);
        $this->db->update('tbl_form_pays', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_pay($id_pay) {
        $this->db->where('id', $id_pay);
        $this->db->delete('tbl_form_pays');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_taxes() {
        $query = $this->db->get('tbl_taxes');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_tax($id) {
        $query = $this->db->get_where('tbl_taxes', array('id' => $id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function add_tax($data) {
        $this->db->insert('tbl_taxes', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit_tax($id_tax, $data) {
        $this->db->where('id', $id_tax);
        $this->db->update('tbl_taxes', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_tax($id_tax) {
        $this->db->where('id', $id_tax);
        $this->db->delete('tbl_taxes');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function assign_pay($idOrder, $data, $data1) {
        $this->db->trans_start();
        $this->db->insert('tbl_orders_pays', $data);
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data1);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function process_pays($idOrder, $idTech, $percent, $value, $idpay, $data, $data1, $data2) {
        $this->db->trans_start();
        $this->db->insert('tbl_orders_pays_pay', $data);
        $this->db->where('id', $idpay);
        $this->db->update('tbl_orders_pays', $data1);
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data2);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function remove_process_pays($idOrder, $idpay, $data, $data1) {
        $this->db->trans_start();
        $this->db->where('id', $idpay);
        $this->db->delete('tbl_orders_pays_pay');
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data);
        $this->db->where('id', $idpay);
        $this->db->update('tbl_orders_pays', $data1);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function remove_pays_state($data) {
        $this->db->where('state', 2);
        $this->db->update('tbl_orders_pays', $data);
    }

}
