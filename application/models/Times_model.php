<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Times_model
 *
 * @author jj
 */
class Times_model extends CI_Model {

    public function get_process() {
        $query = $this->db->get('tbl_orders_state');
        if($query->num_rows()>0){
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    public function get_process_xid($id) {
        $query = $this->db->get_where('tbl_orders_state', array('id' => $id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function add_state($data) {
        $this->db->insert('tbl_orders_state', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit_state($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tbl_orders_state', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_state($id) {
        $this->db->where('id', $id);
        $this->db->delete('tbl_orders_state');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


}
