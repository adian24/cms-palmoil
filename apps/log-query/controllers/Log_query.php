<?php defined('BASEPATH') OR exit("No direct script access allowed");
class Log_query extends SITE_Controller{
    function __construct(){
        parent::__construct();
        $this->fragment['site']['module'] = "log-query";
        $this->page_curr = "log-query";
        $this->load->model("Logquery_model", "logquery");
    }
    function index(){
        if ( !$this->hasLogin() )redirect("auth/signin");
        $this->fragment['site']['css'] = [
            "text/css,stylesheet,".base_url("assets/plugins/datatables/dataTables.bootstrap.min.css"),
        ];
        $this->fragment['site']['js'] = [
            base_url("assets/plugins/datatables/jquery.dataTables").",min,1.0.0",
            base_url("assets/plugins/datatables/dataTables.bootstrap").",min,1.0.0",
            base_url("assets/js/log/log-query").",".ENVIRONMENT.",1.0.2",
        ];
        $this->fragment['page_nav']     = "logger::log-query";
        $this->fragment['page_title']   = "Log Query";
        $this->fragment['page_curr']    = $this->page_curr;
        $this->fragment['pagename']     = "index";
        $this->load->view("main-site", $this->fragment);
    }
    function datalist(){
        $list = $this->logquery->__get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $t) {
            $row        = [];
            $timestamp  = date_format( date_create($t->timestamp), "d F Y H:i:s");
            $device     = ($t->device == 0 ? "Web" : "Apps");
            $row[]      = $timestamp;
            $row[]      = $t->ipaddress;
            $row[]      = $t->username;
            $row[]      = $t->module;
            $row[]      = $device;
            $row[]      = $t->user_agent;
            $row[]      = $t->log_query;
            $data[]     = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->logquery->count_all(),
            "recordsFiltered" => $this->logquery->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
        exit;
    }
}