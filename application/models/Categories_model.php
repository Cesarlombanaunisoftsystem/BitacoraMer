<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of Categories_model
 *
 * @author jhon
 */
class Categories_model extends CI_Model {

    public function get_categories() {
        $query = $this->db->get('tbl_orders_type');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    public function get_category($id_category) {
        $query = $this->db->get_where('tbl_orders_type', array('id' => $id_category));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function add_category($data) {
        $this->db->insert('tbl_orders_type', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function edit_category($id_category, $data) {
        $this->db->where('id', $id_category);
        $this->db->update('tbl_orders_type', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_category($id_category) {
        $this->db->where('id', $id_category);
        $this->db->delete('tbl_orders_type');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
