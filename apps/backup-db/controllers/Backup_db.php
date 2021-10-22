<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: M. Maha Andar Pasaribu
* @Module       : Logger - Backup Database
* @Type         : Controller
* @Date Create	: 22 November 2020
*
***/
class Backup_db extends SITE_Controller
{
    private $page_curr = "";
    function __construct(){
        parent::__construct();
        $this->fragment['site']['module'] = "backup-db";
        $this->page_curr = "backup-db";
    }

    function index()
    {
        if ( !$this->hasLogin() )redirect("auth/signin");
        $this->fragment['page_nav']         = "logger::backup-db";
        $this->fragment['page_title']       = "Logger - Backup Database";
        $this->fragment['page_curr']        = $this->page_curr;
        $this->fragment['pagename']         = "index";
        $this->load->view("main-site", $this->fragment);
    }

    function process()
    {
        $this->load->dbutil();
        $formats = [
            "format"    => "zip",
            "filename"  => "palmoil.sql"
        ];
        $backup =& $this->dbutil->backup($formats);
        $dbname = "palmoil-".date("Y-m-d+H_i_s").".zip";
        $pathfile = "/uploads/".$dbname;

        $this->load->helper("file");
        write_file($pathfile, $backup);

        $this->load->helper("download");
        force_download($dbname, $backup);
        exit;
    }
}