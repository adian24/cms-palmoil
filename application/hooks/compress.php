<?php defined('BASEPATH') OR exit("No direct script access allowed");
	$CI =& get_instance();
	$buffer = $CI->output->get_output();

	$search = [
		'/\>[^\S ]+/s', 
		'/[^\S ]+\</s', 
		'/(\s)+/s', // shorten multiple whitespace sequences
		'#(?://)?<!\[CDATA\[(.*?)(?://)?\]\]>#s' //leave CDATA alone
	];
	$replace = [
		'>',
		'<',
		'\\1',
		"//&lt;![CDATA[\n".'\1'."\n//]]>"
	];

	$buffer = preg_replace($search, $replace, $buffer);

	$CI->output->set_output($buffer);
	$CI->output->_display();