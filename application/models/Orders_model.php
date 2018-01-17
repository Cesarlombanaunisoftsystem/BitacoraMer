<?php

class Orders_model extends CI_Model{

    public function get_order($id){
        $this->db->where('id', $id);
        $this->db->where('idArea', null);
        $this->db->from('tbl_orders');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_order_details($id){
        $this->db->select('tbl_orders_details.*,tbl_orders.idArea');
        $this->db->from('tbl_orders_details');
        $this->db->join('tbl_orders','tbl_orders_details.idOrder=tbl_orders.id');
        $this->db->where('tbl_orders_details.idOrder', $id);
        $this->db->where('tbl_orders.idArea', null);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        } else {
            return false;
        }
    }

    public function add_order($data){
        $this->db->insert('tbl_orders',$data);
        if($this->db->affected_rows()>0){
            return true;
        } else {
            return false;
        }
    }

    public function add_order_detail($data){
        $this->db->insert('tbl_orders_details',$data);
        if($this->db->affected_rows()>0){
            return true;
        } else {
            return false;
        }
    }

    public function remove_order_detail($id){
        $this->db->where('id', $id);
        $this->db->delete('tbl_orders_details');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function register_order($id,$data,$dataDoc1,$dataDoc2,$dataDoc3,$dataDoc4) {
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
}