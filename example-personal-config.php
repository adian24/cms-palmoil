<?php
#SETUP ENVIRONMENT
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
#SETUP THIS PART FOR CONFIGURATION
#SETUP DB CONFIG
define('DBHOST', '127.0.0.1');
define('DBNAME', 'labelmap_db');
define('DBUSER', 'root');
define('DBPASS', '');
#SESSION
define('SESS', 'cms-labelmap');
#ASSET PATH
define("ASSET_URL", "http://asset.labelmap.local/");
#API URL
define("API_URL", "http://api.labelmap.local/");
#API FOLDER
define("API_FOLDER", "api-labelmap");