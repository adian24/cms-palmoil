<?php defined('BASEPATH') OR exit('No direct script access allowed');
/***
*
* @Author				: M. Maha Andar Pasaribu
* @Date Create	: 23 October 2018
* @Module				: Core Controller
* @Version		: 1.0.3
*
***/
class SITE_Controller extends MX_Controller {
	/*** RESERVED WORD ***/
	protected $fragment = array();
	protected $response = [];
	protected $cdn_storage = NULL;
	protected $language = "en";
	protected $slug_search = NULL;
	protected $slug_replace = NULL;
	protected $arr_month = [];
	protected $arr_leave = [];
	protected $data_role = [];
    protected $facility_arr = [];
	protected $front_uri = "";
	function __construct() {
		parent::__construct();
		$this->data_role = [
            "1" => "Admin",
		];
		$this->fragment['site']['data_role'] = $this->data_role;
		/*** 1. PROJECT SITE YEAR ***/
		$this->fragment['site']['year'] = date('Y') == '2021' ? '2021' : "2021 - ".date('Y');
		/*** 2. PROJECT SITE TITLE ***/
		$this->fragment['site']['title'] = "Palm Oil";
		/*** 3. PROJECT SITE SHORTCUT (OPTIONAL) ***/
		$this->fragment['site']['shortcut'] = 'TBS';
		/*** 4. PROJECT SITE VERSION ***/
		$this->fragment['site']['version'] = '1.0.0';
		/*** 5. PROJECT SITE RESPONSE ***/
		$this->response['type'] = 'failed';
		/*** 6. PROJECT USER ACCESS ***/
		$this->fragment['site']['isadd'] = TRUE;
		$this->fragment['site']['ismod'] = TRUE;
		$this->fragment['site']['isdel'] = TRUE;
		/*** 7. PROJECT SETUP CDN STORAGE ***/
		#Modified this in production mode
		#[Modified] Before Push
		$this->cdn_storage = "storages";
		$this->fragment['site']['cdn_storage'] = $this->cdn_storage;
		/*** 8. PROJECT SETUP LANGUAGE ***/
		/*** 9. PROJECT HANDLING NAVIGATION ACCESS ***/
		$allowed_access = ["error404", "maintenance", "", "auth"];
		if ( $this->hasLogin() )
		{
			$curr_nav 	= $this->uri->segment(1);
			$temp		= explode(".", $curr_nav);
			$curr_nav	= count($temp) > 1 ? $temp[0] : $curr_nav;
			if ( !in_array($curr_nav, $allowed_access))
			{
				$myaccess = explode(",", $this->user->getAccess());
				if ( !in_array($curr_nav, $myaccess) )
				{
					redirect("error404");
				}
			}
		}
		/*** 10. PROJECT SETUP NAVIGATION ***/
		if ( $this->hasLogin() )
			$this->fragment['site']['side_menu']	= $this->side_menu();
		/*** 11. PROJECT HANDLING SLUG ***/
		$this->slug_search = [' '  ,'`','~','/','\\'   ,'!','@','#','$','%','^','&','*','(',')','=','{','}',':',';','\''   ,'"','<','>',',','?'];
		$this->slug_replace = ['-' ,'' ,'' ,'' ,''     ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-','' ,'' ,'' ,'' ,''     ,'' ,'' ,'' ,'' ,''];
		/*** 12. GLOBAL MONTH ***/
		$this->arr_month = [
			"1"	=> "January",
			"2"	=> "February",
			"3"	=> "March",
			"4"	=> "April",
			"5"	=> "May",
			"6"	=> "June",
			"7"	=> "July",
			"8"	=> "August",
			"9"	=> "September",
			"10"=> "October",
			"11"=> "November",
			"12"=> "December"
		];
		$this->fragment['site']['arr_month'] = $this->arr_month;
		/*** 13. LEAVE ARRAY DATA ***/
		/*** 14. NOTIFICATION ***/
		/*** 15. Facility Array ***/
        $this->facility_arr = [
            "1" => "wifi.png",
            "2" => "toilet.png",
            "3" => "parkir.png",
            "4" => "musholla.png"
        ];
	}

	function hasLogin(){
		return $this->session->userdata(SESS);
	}
	function side_menu()
	{
		#For Inventory
		$side_menu = [
			"dashboard"		=> [
				"title"		=> "Dashboard",
				"icon"		=> "fa fa-dashboard",
				"child"		=> FALSE,
				"isvis"		=> FALSE,
			],
			// "master"		=> [
			// 	"title"		=> "Master Data",
			// 	"icon"		=> "fa fa-cubes",
			// 	"child"		=> [
			// 		"master-iso"		=> "Data ISO"
			// 	],
			// 	"isvis"		=> FALSE
			// ],
			// "maps"			=> [
			// 	"title"		=> "Maps",
			// 	"icon"		=> "fa fa-map",
			// 	"child"		=> [
			// 		"maps-restaurant"	=> "Restaurant",
			// 		"maps-hotel" 		=> "Hotel",
			// 		"maps-spbu"			=> "SPBU",
			// 		"maps-company"		=> "Company"
			// 	],
			// 	"isvis"		=> FALSE,
			// ],
			"news"		=> [
				"title"		=> "News Management",
				"icon"		=> "fa fa-newspaper-o",
				"child"		=> FALSE,
				"isvis"		=> FALSE,
			],
			"configs"	=> [
				"title"		=> "Pengaturan",
				"icon"		=> "fa fa-cogs",
				"child"		=> [
					"user"			=> "User",
				],
				"isvis"		=> TRUE,
			],
			"logger"		=> [
				"title"		=> "Logger",
				"icon"		=> "fa fa-linux",
				"child"		=> [
					"log-login"	=> "Login",
					"log-query" => "Query",
					"backup-db"	=> "Backup Database"
				],
				"isvis"		=> FALSE,
			],
		];
		return $side_menu;
	}
	function map_access($role="0")
	{
		$results = [];
		if ( $role == "0" ) #dev
		{
			$results = "dashboard,master,master-iso,maps,maps-restaurant,maps-hotel,maps-spbu,maps-company,news,configs,user,logger,log-login,log-query,backup-db";
		}
		else if ( $role == "1" ) #user
		{
			$results = "dashboard,master,master-iso,maps,maps-restaurant,maps-hotel,maps-spbu,maps-company,news";
		}
		return $results;
	}
}
