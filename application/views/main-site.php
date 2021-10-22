<?php defined('BASEPATH') OR exit("No direct script access allowed");
$this->load->view("themes/layout-top");
$this->load->view('../../apps/' . $site['module'] . '/views/' . $pagename);
$this->load->view("themes/layout-bot");