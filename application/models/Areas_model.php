<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Areas_model extends CI_Model {

    public function get_areas() {
        $this->db->select('tbl_areas.*,tbl_state.name_state');
        $this->db->from('tbl_areas');
        $this->db->join('tbl_state','tbl_areas.idState=tbl_state.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_area($id) {
        $query = $this->db->get_where('tbl_areas', array('id' => $id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function add_area($data) {
        $this->db->insert('tbl_areas', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit_area($id_area, $data) {
        $this->db->where('id', $id_area);
        $this->db->update('tbl_areas', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_area($id_area) {
        $this->db->where('id', $id_area);
        $this->db->delete('tbl_areas');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
