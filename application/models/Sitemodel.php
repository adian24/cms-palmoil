<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: M. Maha Andar Pasaribu
* @Date Create	: 16 November 2018
* @Date Revise	: 11 January 2019
* @Version		: 1.0.2
* @Notes		:	+ Initial Commit
					(Version 1.0.1) - 31 December 2018
					+ Creating Navigation
					+ Display Navigation based on User Access
					(Version 1.0.2) - 11 January 2019
					+ Adding Class active for navigation
***/
class Sitemodel extends CI_Model{
	function insert($table, $data){
		$this->db->insert($table, $data);
	}
	
	function insert_batch($table, $data){
		$this->db->insert_batch($table, $data);
	}

	function insertid($table, $data){
		$this->db->insert($table, $data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	function update($table, $data, $where){
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	
	function delete($table, $where){
		$this->db->where($where);
		$this->db->delete($table);
	}
}