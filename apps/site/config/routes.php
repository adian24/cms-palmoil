<?php defined('BASEPATH') OR exit("No direct script access allowed");
	$route['auth/generate-excel']	= "site/generate_excel";
	$route['auth/change-password']	= "site/form_cpass";
	$route['auth/signin.do']		= "site/proc_login";
	$route['auth/signout']			= "site/logout";
	$route['auth/signin']			= "site/login";
	$route['default_controller']	= 'site';