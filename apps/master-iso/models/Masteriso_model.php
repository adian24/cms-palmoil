<?php defined('BASEPATH') OR exit("No direct script access allowed");
class Masteriso_model extends CI_Model
{
    function render($id=0)
    {
        $this->db->select("iso_id,iso_name,iso_type");
        $this->db->where("iso_status", "0");
        if ( empty($id) == FALSE )
            $this->db->Where("iso_id", $id);
        $q = $this->db->get("iso");
        return ($q->num_rows() == 0 ? FALSE : $q->result());
    }
}