<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: M. Maha Andar Pasaribu
* @Module       : Config - User
* @Type         : Model
* @Date Create	: 11 November 2020
*
***/
class Configuser_model extends CI_Model{
    function render($key="")
    {
        $this->db->select("a.user_id,a.user_fname,a.user_name,a.role_id");
        $this->db->where("a.user_status", "0");
        $this->db->where("a.role_id != ", "0");
        if ( empty($key) == FALSE )
            $this->db->where("a.user_id", $key);
        $q = $this->db->get("user a");
        return ($q->num_rows() == 0 ? FALSE : $q->result());
    }
    function check_user($username="",$isnew=TRUE,$id=0)
    {
        if ( $isnew )
        {
            $this->db->select("user_name");
            $this->db->where("user_name", $username);
            $q = $this->db->get("user");
            return ($q->num_rows() == 0 ? TRUE : FALSE);
        }
        else
        {
            $this->db->select("user_id, user_name");
            $this->db->where("user_id", $id);
            $q = $this->db->get("user");
            if ( $q->num_rows() > 0 )
            {
                $olduser = $q->result()[0]->user_name;
                if ( $olduser == $username )
                {
                    return TRUE;
                }
                else
                {
                    $this->db->select("user_name");
                    $this->db->where("user_name", $username);
                    $q = $this->db->get("user");
                    return ($q->num_rows() == 0 ? TRUE : FALSE);
                }
            }
            return TRUE;
        }
    }
}