<?php defined('BASEPATH') OR exit("No direct script access allowed");
class Logger{
    protected $CI = NULL;
    protected $table = NULL;
    function __construct(){
        $this->CI =& get_instance();
        $this->table = [
            "input"     => "log_query",
            "login"     => "log_login",
        ];
    }
    /*
        @table = [
            1. input
                Accepted Parameter :
                1.1 Table   -> table affected for logger
                1.2 Module  -> which module trigger logger
                1.3 message -> contains of last query of execution
                1.4 device  -> which device user used
            2. Login
                3.1 Table   -> table affected for logger
                3.2 module  -> which user access the page
                3.3 message -> contains log message for accessing page
                3.4 device  -> which device user used
                3.5 is_success -> params success in accessing the page
        ]
    */
    function setLogger($table="", $module="Default", $message="-", $device="0", $is_success="0"){
        if ( empty($table) == FALSE ){
            $browser = getBrowser();
            $ua = implode(",", $browser);
            $user = $this->CI->user->getId();
            $time = date("Y-m-d H:i:s");
            $ipaddress = get_client_ip_env();
            if ( $table == "input" ){
                $logger = [
                    "timestamp"     => $time,
                    "ipaddress"     => $ipaddress,
                    "username"      => $user,
                    "module"        => $module,
                    "device"        => $device,
                    "user_agent"    => $ua,
                    "log_query"     => $message,
                ];
            }
            else if ( $table == "login" ){
                $logger = [
                    "timestamp"		=> $time,
                    "ipaddress"		=> $ipaddress,
                    "username"		=> $module,
                    "status"	    => $is_success,
                    "msg"		    => $message,
                    "device"		=> $device,
                    "user_agent"	=> $ua,
                ];
            }
            
            $this->CI->sitemodel->insert($this->table[$table], $logger);
        }
    }
}