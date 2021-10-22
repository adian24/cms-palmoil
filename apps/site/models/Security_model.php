<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: News Team
* @Module       : Site - Security
* @Type         : Model
* @Date Create	: 28 January 2021
*
***/
class Security_model extends CI_Model{
    function check($username=""){
        $this->db->select("user_id,user_name,user_pwd,user_fname,role_id");
        $this->db->where("user_name", $username);
        $this->db->where("user_status", "0");
        $q = $this->db->get('user');
        return ($q->num_rows() == 0 ? FALSE : $q->result());
    }
}