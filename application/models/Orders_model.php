<?php

class Orders_model extends CI_Model {

    public function get_order_bitacora($id) {
        $this->db->where('id', $id);
        $this->db->where('idArea', null);
        $this->db->where('idOrderState', 1);
        $this->db->where('idOrderType', 1);
        $this->db->from('tbl_orders');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_order_by_id_email($idOrder) {
        $sql = 'SELECT tbl_orders.*,max(tbl_orders_details.idActivities),tbl_orders_details.idServices,tbl_orders_details.site,
            tbl_activities.name_activitie,tbl_services.name_service,tbl_users.name_user FROM tbl_orders JOIN tbl_orders_details
            ON tbl_orders.id = tbl_orders_details.idOrder JOIN tbl_activities ON 
            tbl_orders_details.idActivities = tbl_activities.id JOIN tbl_services ON
            tbl_orders_details.idServices = tbl_services.id JOIN tbl_users ON
            tbl_orders.idTechnicals = tbl_users.id WHERE tbl_orders.id=' . $idOrder . ' GROUP BY tbl_orders.id';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function get_orders_tray() {
        $this->db->select('tbl_orders.*,tbl_users.name_user,tbl_orders_details.id AS `idOrderDetail`,tbl_orders_details.idActivities,tbl_orders_details.idServices,tbl_orders_details.site,'
                . 'tbl_orders_details.price,tbl_orders_details.count,tbl_orders_details.total AS `totalDetail`,tbl_activities.name_activitie,tbl_services.name_service');
        $this->db->from('tbl_orders');
        $this->db->join('tbl_users', 'tbl_orders.idCoordinatorExt=tbl_users.id');
        $this->db->join('tbl_orders_details', 'tbl_orders.id=tbl_orders_details.idOrder');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('tbl_orders.idArea',1);
        $this->db->where('tbl_orders.idOrderState',2);
        $this->db->group_by('tbl_orders.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_orders_design($status) {
        $this->db->select('tbl_orders.*,tbl_users.name_user,tbl_orders_details.id AS `idOrderDetail`,tbl_orders_details.idActivities,tbl_orders_details.idServices,tbl_orders_details.count,tbl_orders_details.site,'
                . 'tbl_activities.name_activitie,tbl_services.name_service');
        $this->db->from('tbl_orders');
        $this->db->join('tbl_users', 'tbl_orders.idCoordinatorExt=tbl_users.id');
        $this->db->join('tbl_orders_details', 'tbl_orders.id=tbl_orders_details.idOrder');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('tbl_orders.idArea',2);
        $this->db->where('tbl_orders.idOrderState',$status);
        $this->db->group_by('tbl_orders.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_order_details($id) {
        $this->db->select('tbl_orders_details.*,tbl_orders.idArea,tbl_activities.name_activitie,tbl_services.name_service');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_orders', 'tbl_orders_details.idOrder=tbl_orders.id');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('tbl_orders_details.idOrder', $id);
        $this->db->where('tbl_orders.idArea', null);
        $this->db->where('tbl_orders.idOrderState', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function details_orders_tray($id) {
        $this->db->select('tbl_orders_details.*,tbl_orders.idArea,tbl_activities.name_activitie,tbl_services.name_service');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_orders', 'tbl_orders_details.idOrder=tbl_orders.id');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('tbl_orders_details.idOrder', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function add_order($data) {
        $this->db->insert('tbl_orders', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function add_order_detail($data) {
        $this->db->insert('tbl_orders_details', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function add_order_document($data) {
        $this->db->insert('tbl_orders_documents', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update_order($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tbl_orders', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function remove_order_detail($id) {
        $this->db->where('id', $id);
        $this->db->delete('tbl_orders_details');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function register_order($id, $data, $dataDoc1, $dataDoc2, $dataDoc3, $dataDoc4) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('tbl_orders', $data);
        $this->db->insert('tbl_orders_documents', $dataDoc1);
        $this->db->insert('tbl_orders_documents', $dataDoc2);
        $this->db->insert('tbl_orders_documents', $dataDoc3);
        $this->db->insert('tbl_orders_documents', $dataDoc4);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function upload_pdf($id,$imagen) {
            $data = array(
                'picture' => $imagen
            );
            $this->db->where('id', $id);
            $this->db->update('tbl_orders', $data);
    }

    public function get_docs($idOrder) {
        $this->db->select('tbl_orders_documents.*,tbl_type_documents.name_type');
        $this->db->from('tbl_orders_documents');
        $this->db->join('tbl_type_documents', 'tbl_orders_documents.idTypeDocument=tbl_type_documents.id');
        $this->db->where('tbl_orders_documents.idOrder', $idOrder);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function upload_attached_record($idOrder, $file) {
        $data = array(
            'picture' => $file);
        $this->db->where('id',$idOrder);
        $this->db->update('tbl_orders', $data);
    }

}
