<?php

class Orders_model extends CI_Model{

    public function get_order($id){
        $query = $this->db->get_where('tbl_orders', array('id' => $id));
        if($query->num_rows()>0){
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_order_details($id){
        $query = $this->db->get_where('tbl_orders_details', array('idOrder' => $id));
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
}