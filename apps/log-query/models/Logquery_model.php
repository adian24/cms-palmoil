<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Ryan Irsandi
* @Module       : Company
* @Type         : Model
* @Date Create	: 23 April 2019
* @Date Revise	: 24 April 2019
* @Version		: 1.0.1
* @Notes		:	+ Initial Commit
                    (Version 1.0.1) - 02 January 2019
                    + Fixing bug when editing user access
*
***/
class Logquery_model extends CI_Model{
    protected $table = "log_query";
    protected $column_order = ["timestamp", "ipaddress", "username", "module", "device", "user_agent", "log_query"];
    protected $column_search = ["timestamp", "ipaddress", "username", "module", "device", "user_agent", "log_query"];
    protected $order = ["timestamp" => "desc"];
    private function __get_datatables_query(){
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
        if(isset($_POST['order'])){
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function __get_datatables(){
        $this->__get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered(){
        $this->__get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}