<?php defined('BASEPATH') OR exit("No direct script access allowed");
	class User{
		var $user = NULL;
		function __construct(){
			$CI =& get_instance();
			$CI->load->library('session');
			$this->user = ($CI->session->userdata(SESS)) ? $CI->session->userdata(SESS) : NULL;
		}
		
		function getId(){return ($this->user) ? $this->user->id : NULL;}
		function getUser(){return ($this->user) ? $this->user->user : NULL;}
		function getName(){return ($this->user) ? $this->user->name : NULL;}
		function getRole(){return ($this->user) ? $this->user->role : NULL;}
		function getAccess(){return ($this->user) ? $this->user->access : NULL;}
		function getWhId(){return ($this->user) ? $this->user->wh_id : NULL;}
		function getWarehouse(){return ($this->user) ? $this->user->warehouse : NULL;}
		function getPhoto(){return ($this->user) ? $this->user->photo : NULL;}
	}