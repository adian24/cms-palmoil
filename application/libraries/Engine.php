<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: M. Maha Andar Pasaribu
* @Module       : Engine - API
* @Type         : Library
* @Date Create	: 26 June 2018
* @Date Revise	: 12 June 2018
* @Version		: 1.0.0
* @Notes		:	+ Initial Commit
*
***/
class Engine{
    private $module = "apps";
    private $path = ENVIRONMENT == "development" ? "development.json" : "release.json";
    private $content = "";
    private $file = NULL;
    private $arr_dir = [];
    private $mx = [];
    private $core = [];
    function __construct(){
        if ( !file_exists("./".$this->path) ) die("No instance loader found. Please setup a new one.");
        if ( !file_exists($this->module) ) die("Invalid path module, please correct path.");
        $this->content = file_get_contents($this->path);
        $this->file = json_decode($this->content);
    }
    function load_mx(){
        if ( $this->file ){
            foreach($this->file as $key=>$val)
                $this->mx["{$key}"] = [ $val->core ] ;
        }
        return $this->mx;
    }
}