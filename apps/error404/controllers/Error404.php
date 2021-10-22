<?php defined('BASEPATH') OR exit("No direct script access allowed");
	class Error404 extends SITE_Controller{
		function __construct(){
			$this->fragment['site']['module'] = "error404";
			parent::__construct();
		}
		function index(){
			if ( !$this->hasLogin() )redirect('auth/signin');
			$this->fragment['page_title'] = "Page not found";
			$this->fragment['pagename'] = "index";
			$this->load->view("main-site", $this->fragment);
		}
	}