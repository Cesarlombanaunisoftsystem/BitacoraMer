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
        $query = $this->db->get_where('tbl_orders_pays', array('idOrder' => $idOrder));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_pays_xusers() {
        $sql = 'SELECT tbl_orders.uniquecode,tbl_orders.uniqueCodeCentralCost,
            tbl_orders.idFormPay, pagos.sumValue, pagos.idTechnical,
            details.idActivities, details.count, details.site,
            details.totalOrder, details.totalCost, act.name_activitie,
            serv.name_service, tecn.name_user, tecn.identify_number, tecn.address,
            tecn.phone,tecn.email,tecn.contact,pay.name_pay,bank.name_bank,
            account.number_account
    FROM tbl_orders
    LEFT JOIN (SELECT id,name_pay
   FROM tbl_form_pays) pay
    ON pay.id = tbl_orders.idFormPay
   LEFT JOIN (SELECT idOrder, min(idActivities) idActivities, min(idServices)
   idServices, count, site, sum(total) totalOrder, sum(total_cost) totalCost
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
    LEFT JOIN (SELECT id, idAccount, name_user, identify_number, address, phone,
    email, contact
   FROM tbl_users
    GROUP BY id) tecn
    ON tbl_orders.idTechnicals = tecn.id
    LEFT JOIN (SELECT id,number_account,idBank
    FROM tbl_accounts) account
    ON account.id = tecn.idAccount
    LEFT JOIN (SELECT id,name_bank
    FROM tbl_banks) bank
    ON bank.id = account.idBank
    LEFT JOIN (SELECT idOrder,idTechnical, sum(value) sumValue, state
    FROM tbl_orders_pays
    GROUP BY idOrder) pagos
    ON tbl_orders.id = pagos.idOrder where pagos.state=2';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_pays_process() {
        $sql = 'SELECT tbl_orders.uniquecode,tbl_orders.uniqueCodeCentralCost, pagos.sumValue, pagos.dateSave, tecn.name_user
    FROM tbl_orders
    LEFT JOIN (SELECT id,name_user
   FROM tbl_users
    GROUP BY id) tecn
    ON tbl_orders.idTechnicals = tecn.id
    LEFT JOIN (SELECT idOrder, sum(value) sumValue, state, dateSave
    FROM tbl_orders_pays
    GROUP BY idOrder) pagos
    ON tbl_orders.id = pagos.idOrder where pagos.state=0';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
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

    public function process_pays($idOrder, $data, $data1) {
        $this->db->trans_start();
        $this->db->where('idOrder', $idOrder);
        $this->db->update('tbl_orders_pays', $data);
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data1);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function remove_process_pays($idOrder, $data, $data1) {
        $this->db->trans_start();
        $this->db->where('idOrder', $idOrder);
        $this->db->update('tbl_orders_pays', $data);
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data1);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function remove_pays_state($data) {
        $this->db->where('state', 2);
        $this->db->update('tbl_orders_pays',$data);
    }

}
