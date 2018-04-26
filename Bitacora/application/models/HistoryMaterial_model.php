<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HistoryMaterial_model extends CI_Model {
    
    public function add_register($data) {
        $this->db->insert('tbl_history_material', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function delete_register($id) {
        $this->db->delete('tbl_history_material', array('id' => $id));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
}