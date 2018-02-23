<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of Materials_model
 *
 * @author jj
 */
class Materials_model extends CI_Model {

    public function assign($id, $idOrder, $data, $data1) {
        $this->db->where('id', $id);
        $this->db->update('tbl_orders_details', $data);
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data1);
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function assign_materials_x_order($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tbl_orders', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function assign_state($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tbl_orders_details', $data);
        if ($this->db->affected_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_data_cellar_order($order,$cellar) {
        $sql = "SELECT tbl_orders_details.*, serv.name_service, serv.unit_measurement,
            bod.name_cellar, bod.contact_cellar, bod.image
    FROM tbl_orders_details
    LEFT JOIN (SELECT id, name_service, unit_measurement
   FROM tbl_services
    GROUP BY id) serv
    ON tbl_orders_details.idServices= serv.id
    LEFT JOIN (SELECT id, name_cellar, contact_cellar, image
   FROM tbl_cellars
    GROUP BY id) bod
    ON tbl_orders_details.idCellar= bod.id
    WHERE tbl_orders_details.idOrder = '$order' AND tbl_orders_details.idActivities = 5
    AND tbl_orders_details.idCellar = '$cellar'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_materials($idOrder,$cellar) {
        $this->db->select('tbl_orders_details.*,tbl_activities.name_activitie,'
                . 'tbl_services.name_service,tbl_services.unit_measurement,'
                . 'tbl_cellars.name_cellar, tbl_cellars.contact_cellar');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->join('tbl_cellars', 'tbl_orders_details.idCellar=tbl_cellars.id');
        $this->db->where('tbl_orders_details.idOrder', $idOrder);
        $this->db->where('tbl_orders_details.idActivities', 5);
        $this->db->where('tbl_orders_details.idCellar', $cellar);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }
    
    public function get_materials_cellar($idOrder) {
        $this->db->select('tbl_orders_details.*,tbl_activities.name_activitie,'
                . 'tbl_services.name_service,tbl_services.unit_measurement,'
                . 'tbl_cellars.name_cellar, tbl_cellars.contact_cellar');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->join('tbl_cellars', 'tbl_orders_details.idCellar=tbl_cellars.id');
        $this->db->where('tbl_orders_details.idOrder', $idOrder);
        $this->db->where('tbl_orders_details.idActivities', 5);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

}