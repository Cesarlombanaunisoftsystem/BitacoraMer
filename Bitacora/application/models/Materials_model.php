<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of Materials_model
 *
 * @author JHON JAIRO VALDÉS ARISTIZABAL
 */
class Materials_model extends CI_Model {

    public function get_materials_order($idOrder) {
        $this->db->select('tbl_orders_details.*,tbl_activities.name_activitie,'
                . 'tbl_services.name_service,tbl_services.unit_measurement,'
                . 'tbl_cellars.name_cellar, tbl_cellars.contact_cellar');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->join('tbl_cellars', 'tbl_orders_details.idCellar=tbl_cellars.id');
        $this->db->where('tbl_orders_details.idOrder', $idOrder);
        $this->db->where('tbl_orders_details.idActivities', 22);
        $this->db->or_where('tbl_orders_details.idActivities', 34);
        $this->db->or_where('tbl_orders_details.idActivities', 35);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function assign($id, $idOrder, $data, $data1) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('tbl_orders_details', $data);
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data1);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function assign_cellar_x_order($idOrder, $data, $data1) {
        $this->db->trans_start();
        $this->db->where('idOrder', $idOrder);
        $this->db->where('idActivities', 22);
        $this->db->or_where('idActivities', 34);
        $this->db->or_where('idActivities', 35);
        $this->db->update('tbl_orders_details', $data);
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data1);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
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

    public function register_materials_back($id, $data, $data1) {
        $this->db->where('id', $id);
        $this->db->update('tbl_orders', $data);
        $this->db->insert('tbl_daily_management', $data1);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function register_back($id, $idDetail, $data, $data2) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('tbl_materials_back', $data);
        $this->db->where('id', $idDetail);
        $this->db->update('tbl_orders_details', $data2);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function return_materials($data) {
        $this->db->insert('tbl_materials_back', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function obsv_materials($data) {
        $this->db->insert('tbl_obs_material', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function return_materials_log($idOrder, $data1, $data2) {
        $this->db->trans_start();
        $this->db->insert('tbl_daily_management', $data1);
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data2);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function unregister_back($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tbl_materials_back', $data);
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
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_data_cellar_order($order, $cellar) {
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
    WHERE tbl_orders_details.idOrder = '$order' AND
        (tbl_orders_details.idActivities = 22 OR tbl_orders_details.idActivities = 34 OR tbl_orders_details.idActivities = 35)
    AND tbl_orders_details.idCellar = '$cellar'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_materials($idOrder, $cellar) {
        $this->db->select('tbl_orders_details.*,tbl_orders.statematerial,tbl_activities.name_activitie,'
                . 'tbl_services.name_service,tbl_services.unit_measurement,'
                . 'tbl_cellars.name_cellar, tbl_cellars.contact_cellar');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_orders', 'tbl_orders_details.idOrder=tbl_orders.id');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->join('tbl_cellars', 'tbl_orders_details.idCellar=tbl_cellars.id');
        $this->db->where('tbl_orders_details.idOrder', $idOrder);
        $this->db->where('tbl_orders_details.idActivities', 22);
        $this->db->or_where('tbl_orders_details.idActivities', 34);
        $this->db->or_where('tbl_orders_details.idActivities', 35);
        $this->db->where('tbl_orders_details.idCellar', $cellar);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    public function get_materials_back($idOrder, $cellar) {
        $this->db->select('tbl_orders_details.*,tbl_activities.name_activitie,'
                . 'tbl_services.name_service,tbl_services.unit_measurement,'
                . 'tbl_cellars.name_cellar, tbl_cellars.contact_cellar,tbl_materials_back.state stateBack');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->join('tbl_cellars', 'tbl_orders_details.idCellar=tbl_cellars.id');
        $this->db->join('tbl_materials_back', 'tbl_orders_details.id=tbl_materials_back.iddetail');
        $this->db->where('tbl_orders_details.idOrder', $idOrder);
        $this->db->where('tbl_orders_details.idActivities', 22);
        $this->db->or_where('tbl_orders_details.idActivities', 34);
        $this->db->or_where('tbl_orders_details.idActivities', 35);
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
        $this->db->where('tbl_orders_details.idActivities', 22);
        $this->db->or_where('tbl_orders_details.idActivities', 34);
        $this->db->or_where('tbl_orders_details.idActivities', 35);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

}
