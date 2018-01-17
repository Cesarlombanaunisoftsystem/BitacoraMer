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
        $query = $this->db->get_where('tbl_taxes',  array('id' => $id));
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
}
