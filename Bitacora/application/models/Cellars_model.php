<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of Cellars_model
 *
 * @author JHON JAIRO VALDÉS ARISTIZABAL
 */
class Cellars_model extends CI_Model {

    public function get_cellars() {
        $this->db->select('tbl_cellars.*,tbl_state.name_state');
        $this->db->from('tbl_cellars');
        $this->db->join('tbl_state', 'tbl_cellars.idState=tbl_state.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_materials_cellar($idCellar) {
        $sql = "SELECT tbl_orders_details.*,tbl_orders.dateSave,tbl_orders.uniquecode,
            tbl_orders.coi,tbl_orders.uniqueCodeCentralCost,tbl_orders.stateMaterial,
            tbl_activities.name_activitie,tbl_users.name_user FROM tbl_orders_details
            JOIN tbl_orders ON tbl_orders_details.idOrder = tbl_orders.id JOIN tbl_activities 
    ON tbl_orders_details.idActivities= tbl_activities.id JOIN tbl_users ON tbl_orders.idTechnicals = tbl_users.id
    where tbl_orders_details.idCellar='$idCellar' AND tbl_orders_details.idStateCellar = 1"
                . " AND (tbl_orders.stateMaterial = 1 || tbl_orders.stateMaterial = 2) group by tbl_orders_details.idOrder";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_materials_cellar_process($id, $idCellar, $state) {
        $sql = "SELECT tbl_logs.*,tbl_orders_details.*,tbl_orders.uniquecode,
            tbl_orders.coi,tbl_orders.uniqueCodeCentralCost,tbl_orders.stateMaterial,
            tbl_activities.name_activitie,tbl_users.name_user FROM tbl_logs JOIN
            tbl_orders_details ON tbl_logs.idOrder=tbl_orders_details.idOrder JOIN
            tbl_orders ON tbl_orders_details.idOrder = tbl_orders.id JOIN tbl_activities 
            ON tbl_orders_details.idActivities= tbl_activities.id JOIN tbl_users ON
    tbl_orders.idTechnicals = tbl_users.id where tbl_orders_details.idCellar = $idCellar
        AND tbl_logs.idProcessState = $state AND tbl_logs.idUserProcess = $id group by tbl_logs.idOrder order by tbl_logs.id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_cellar($id) {
        $query = $this->db->get_where('tbl_cellars', array('id' => $id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function add_cellar($data) {
        $this->db->insert('tbl_cellars', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit_cellar($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tbl_cellars', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_cellar($id) {
        $this->db->where('id', $id);
        $this->db->delete('tbl_areas');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
