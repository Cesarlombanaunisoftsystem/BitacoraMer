<?php

class Orders_model extends CI_Model {

    public function get_order_bitacora($id, $type) {
        $this->db->where('id', $id);
        $this->db->where('idArea', null);
        $this->db->where('idOrderState', 1);
        $this->db->where('idOrderType', $type);
        $this->db->where('idUser', $this->session->userdata('id_usuario'));
        $this->db->from('tbl_orders');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_order($order) {
        $this->db->select('uniquecode');
        $this->db->from('tbl_orders');
        $this->db->where('uniquecode', $order);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_order_by_id($idOrder) {
        $sql = "SELECT tbl_orders.*,min(tbl_orders_details.idActivities),
            tbl_orders_details.idServices,tbl_orders_details.site,
            tbl_orders_details.count,tbl_activities.name_activitie,
            tbl_services.name_service,tbl_users.name_user,tbl_users.email,
            tbl_users.identify_number,tbl_users.contact,tbl_users.address,
            tbl_users.phone FROM tbl_orders JOIN tbl_orders_details
            ON tbl_orders.id = tbl_orders_details.idOrder JOIN tbl_activities ON 
            tbl_orders_details.idActivities = tbl_activities.id JOIN tbl_services ON 
            tbl_orders_details.idServices = tbl_services.id JOIN tbl_users ON
            tbl_orders.idTechnicals = tbl_users.id WHERE tbl_orders.id='$idOrder'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function get_report_pays_xiduser($id) {
        $sql = "SELECT A.id, A.uniquecode, A.uniqueCodeCentralCost, A.idFormPay, A.idTechnicals, B.totalPays, C.name_user, C.identify_number,
C.address, C.phone, C.email, C.contact, C.idAccount, D.name_pay, F.number_account, E.name_bank,
F.number_account, G.count, G.site, H.name_activitie FROM tbl_orders A
   LEFT JOIN (SELECT id, name_pay
   FROM tbl_form_pays
    GROUP BY id) D
    ON D.id= A.idFormPay
    LEFT JOIN (SELECT idOrder, min(idActivities) idActivities, count, site
   FROM tbl_orders_details
    GROUP BY idOrder) G
    ON G.idOrder= A.id
   	LEFT JOIN (SELECT id, name_activitie
   FROM tbl_activities
    GROUP BY id) H
    ON H.id= G.idActivities
    LEFT JOIN (SELECT id, name_user, identify_number, address, phone, email, contact, idAccount
   FROM tbl_users
    GROUP BY id) C
    ON A.idTechnicals = C.id
    LEFT JOIN (SELECT id, number_account, idBank
   FROM tbl_accounts
    GROUP BY id) F
    ON C.idAccount = F.id
    LEFT JOIN (SELECT id, name_bank
   FROM tbl_banks
    GROUP BY id) E
    ON E.id = F.idBank
    LEFT JOIN (SELECT idOrder, SUM(value) totalPays
   FROM tbl_orders_pays
    GROUP BY idOrder) B
    ON B.idOrder = A.id
    WHERE C.id = '$id' AND A.idOrderState = 12 group by B.idOrder";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_observation_order($id) {
        $this->db->select('observations');
        $this->db->from('tbl_orders');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_order_by_id_email($idOrder) {
        $sql = "SELECT tbl_orders.*,max(tbl_orders_details.idActivities),
            tbl_orders_details.idServices,tbl_orders_details.site,
            tbl_orders_details.count,tbl_activities.name_activitie,
            tbl_services.name_service,tbl_users.name_user,tbl_users.email,
            tbl_users.identify_number,tbl_users.contact,tbl_users.address,
            tbl_users.phone FROM tbl_orders JOIN tbl_orders_details
            ON tbl_orders.id = tbl_orders_details.idOrder JOIN tbl_activities ON 
            tbl_orders_details.idActivities = tbl_activities.id JOIN tbl_services ON 
            tbl_orders_details.idServices = tbl_services.id JOIN tbl_users ON
            tbl_orders.idTechnicals = tbl_users.id WHERE tbl_orders.id='$idOrder'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function get_order_by_email_coordext($idOrder) {
        $sql = "SELECT tbl_orders.*,max(tbl_orders_details.idActivities),
            tbl_orders_details.idServices,tbl_orders_details.site,
            tbl_orders_details.count,tbl_activities.name_activitie,
            tbl_services.name_service,tbl_users.name_user,tbl_users.email,
            tbl_users.identify_number,tbl_users.contact,tbl_users.address,
            tbl_users.phone FROM tbl_orders JOIN tbl_orders_details
            ON tbl_orders.id = tbl_orders_details.idOrder JOIN tbl_activities ON 
            tbl_orders_details.idActivities = tbl_activities.id JOIN tbl_services ON 
            tbl_orders_details.idServices = tbl_services.id JOIN tbl_users ON
            tbl_orders.idCoordinatorExt = tbl_users.id WHERE tbl_orders.id='$idOrder'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function get_orders_tray() {
        $this->db->select('tbl_orders.*,tbl_users.name_user,tbl_orders_details.id AS idOrderDetail,tbl_orders_details.idActivities,tbl_orders_details.idServices,tbl_orders_details.site,'
                . 'tbl_orders_details.price,tbl_orders_details.count,tbl_orders_details.total AS totalDetail,tbl_activities.name_activitie,tbl_services.name_service');
        $this->db->from('tbl_orders');
        $this->db->join('tbl_users', 'tbl_orders.idCoordinatorExt=tbl_users.id');
        $this->db->join('tbl_orders_details', 'tbl_orders.id=tbl_orders_details.idOrder');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('tbl_orders.idArea', 1);
        $this->db->where('tbl_orders.idOrderState', 2);
        $this->db->group_by('tbl_orders.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_orders_design($area, $status) {
        $this->db->select('tbl_orders.*,tbl_users.name_user,tbl_orders_details.id AS idOrderDetail,tbl_orders_details.idActivities,tbl_orders_details.idServices,tbl_orders_details.count,tbl_orders_details.site,'
                . 'tbl_activities.name_activitie,tbl_services.name_service');
        $this->db->from('tbl_orders');
        $this->db->join('tbl_users', 'tbl_orders.idCoordinatorExt=tbl_users.id');
        $this->db->join('tbl_orders_details', 'tbl_orders.id=tbl_orders_details.idOrder');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('tbl_orders.idArea', $area);
        $this->db->where('tbl_orders.idOrderState', $status);
        $this->db->group_by('tbl_orders.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_order_details($id, $type) {
        $this->db->select('tbl_orders_details.*,tbl_orders.idArea,tbl_activities.name_activitie,tbl_services.name_service');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_orders', 'tbl_orders_details.idOrder=tbl_orders.id');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('tbl_orders_details.idOrder', $id);
        $this->db->where('tbl_orders.idArea', null);
        $this->db->where('tbl_orders.idOrderState', 1);
        $this->db->where('tbl_orders.idOrderType', $type);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_details_xid($id) {
        $this->db->select('tbl_orders_details.*, tbl_activities.name_activitie, tbl_services.name_service');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('tbl_orders_details.id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_details_service($id, $idService) {
        $this->db->select('tbl_orders_details.idServices');
        $this->db->from('tbl_orders_details');
        $this->db->where('tbl_orders_details.idOrder', $id);
        $this->db->where('tbl_orders_details.idServices', $idService);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
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
    
    public function update_order_detail($id,$data) {
        $this->db->where('id', $id);
        $this->db->update('tbl_orders_details', $data);
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

    public function upload_pdf($id, $imagen) {
        $data = array(
            'picture' => $imagen
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_orders', $data);
    }

    public function upload_doc($idOrder, $idType, $data) {
        $this->db->where('idTypeDocument', $idType);
        $this->db->where('idOrder', $idOrder);
        $this->db->update('tbl_orders_documents', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function upload_docs($data) {
        $this->db->insert('tbl_orders_documents', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
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

    public function get_materials($idOrder) {
        $this->db->select('tbl_orders_details.*,tbl_activities.name_activitie,'
                . 'tbl_services.name_service,tbl_services.unit_measurement');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('tbl_orders_details.idOrder', $idOrder);
        $this->db->where('tbl_orders_details.idActivities', 5);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    public function get_materials_by_cellar($idOrder, $idCellar) {
        $this->db->select('tbl_orders_details.*,tbl_activities.name_activitie,'
                . 'tbl_services.name_service,tbl_services.unit_measurement');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_activities', 'tbl_orders_details.idActivities=tbl_activities.id');
        $this->db->join('tbl_services', 'tbl_orders_details.idServices=tbl_services.id');
        $this->db->where('tbl_orders_details.idOrder', $idOrder);
        $this->db->where('tbl_orders_details.idActivities', 5);
        $this->db->where('tbl_orders_details.idCellar', $idCellar);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    public function upload_attached_record($idOrder, $file) {
        $data = array(
            'picture' => $file);
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data);
    }

    public function get_observations_detail($id) {
        $this->db->select('observation');
        $this->db->from('tbl_orders_documents');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function assign_state($idOrder, $data) {
        $this->db->where('id', $idOrder);
        $this->db->update('tbl_orders', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_reg_photos_xid($id) {
        $sql = "SELECT file FROM tbl_orders_documents WHERE idOrder='$id' AND"
                . " idTypeDocument = 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    
    public function get_total_orders() {
        $sql = "SELECT count(id) as total FROM tbl_orders";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            return $query->row();
        } else {
            return FALSE;
        }
    }
    
    public function get_total_sale() {
        $sql = "SELECT sum(total) as total FROM tbl_orders";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            return $query->row();
        } else {
            return FALSE;
        }
    }
    
    public function get_total_cost() {
        $sql = "SELECT sum(total_cost) as total FROM tbl_orders_details";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            return $query->row();
        } else {
            return FALSE;
        }
    }

}
