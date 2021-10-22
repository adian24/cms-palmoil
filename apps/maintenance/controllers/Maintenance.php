<?php defined('BASEPATH') OR exit("No direct script access allowed");
	class Maintenance extends SITE_Controller{
		function __construct(){
			$this->fragment['site']['module'] = "maintenance";
			parent::__construct();
		}
		function index(){
			if ( !$this->hasLogin() )redirect('auth/signin');
			$this->fragment['page_title'] = "Maintenance";
			$this->fragment['pagename'] = "index";
			$this->load->view("main-site", $this->fragment);
		}
	}