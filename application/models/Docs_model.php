<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Description of Docs_model
 *
 * @author jhon
 */
class Docs_model extends CI_Model{
    public function get_docs() {
        $this->db->select('tbl_type_documents.*,tbl_state.name_state');
        $this->db->from('tbl_type_documents');
        $this->db->join('tbl_state','tbl_type_documents.idState=tbl_state.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_doc($id) {
        $query = $this->db->get_where('tbl_type_documents', array('id' => $id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function add_doc($data) {
        $this->db->insert('tbl_type_documents', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit_doc($id_doc, $data) {
        $this->db->where('id', $id_doc);
        $this->db->update('tbl_type_documents', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_doc($id_doc) {
        $this->db->where('id', $id_doc);
        $this->db->delete('tbl_type_documents');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
