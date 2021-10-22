<?php defined('BASEPATH') OR exit("No direct script access allowed");

if(!function_exists('mempty')){
	function mempty($value=""){
		$value = trim($value);
		return (empty($value) ? TRUE : FALSE);
	}
}

if(!function_exists('esc')){
	function esc(&$value){
		$value = trim(html_escape($value));
	}
}

if(!function_exists('xss_filter')){
	function xss_filter($array){
		array_walk($array, 'esc');
	}
}

if ( ! function_exists('ist')){
    function ist( & $var, $default = ""){
		$t = "";
		if ( !isset($var)  || !$var ) {
			if (isset($default) && $default != "") $t = $default;
		}
		else  {  
			$t = $var;
		}
		if (is_string($t)) $t = trim($t);
		return htmlentities(stripslashes(utf8_decode($t)));
	}
}

if ( ! function_exists('proper_lang') ){
	function proper_lang( $item, $default = true ){
		$explode = explode(" ", $item);
		$temp = [];
		$length = $default ? 3 : 2;
		foreach ($explode as $x){
			$x = strlen(trim($x)) <= $length ? strtoupper($x) : ucwords( strtolower ( trim ($x) ) );
			array_push($temp, $x);
		}
		$result = implode(" ", $temp);
		return $result;
	}
}

if(!function_exists('sendEmail')){
	
	function sendEmail($to, $subject, $content){
		
		$config = array(
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'xxxx',
			'smtp_port' 	=> 25,
			'smtp_user' 	=> 'xxxx',
			'smtp_pass' 	=> 'xxxx',
			'mailtype' 		=> 'html',
			'charset' 		=> 'iso-8859-1',
			'newline'		=> "\r\n",
			'wordwrap' 		=> TRUE
		);
		$CI = &get_instance();
		$CI->load->library('email', $config);		
		$CI->email->from('xxxxx', 'xxxx');
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($content);
		return $CI->email->send();
	}
}

if ( !function_exists('penyebut') ){
	function penyebut($nilai){
		$nilai = abs($nilai);
		$huruf = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
		$temp = "";
		if ( $nilai < 12 ) $temp = " ".$huruf[$nilai];
		else if ( $nilai < 20 )$temp = penyebut($nilai - 10)." belas";
		else if ( $nilai < 100 )$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		else if ( $nilai < 200 )$temp = " seratus".penyebut($nilai - 100);
		else if ( $nilai < 1000 )$temp = penyebut($nilai/100). " ratus". penyebut($nilai %100);
		else if ( $nilai < 2000 )$temp = " seribu" . penyebut($nilai - 1000);
		else if ( $nilai < 1000000 )$temp = penyebut($nilai/1000). " ribu".penyebut($nilai % 1000);
		else if ( $nilai < 1000000000 )$temp = penyebut($nilai/1000000). " juta". penyebut($nilai % 1000000);
		else if ( $nilai < 1000000000000 )$temp = penyebut($nilai/1000000000). " milyar".penyebut(fmod($nilai, 1000000000));
		else if ( $nilai < 1000000000000000 )$temp = penyebut($nilai/1000000000000). " trilyun".penyebut(fmod($nilai, 1000000000000));
		return $temp;
	}
}

if ( !function_exists('resize_image') ){
	function resize_image($file, $w="262", $h="122", $crop=false, $destination="") {
		list($width, $height) = getimagesize($file);
		$r = $width / $height;
		if ($crop) {
			if ($width > $height) {
				$width = ceil($width-($width*abs($r-$w/$h)));
			} else {
				$height = ceil($height-($height*abs($r-$w/$h)));
			}
			$newwidth = $w;
			$newheight = $h;
		} else {
			if ($w/$h > $r) {
				$newwidth = $h*$r;
				$newheight = $h;
			} else {
				$newheight = $w/$r;
				$newwidth = $w;
			}
		}
		
		//Get file extension
		$exploding = explode(".",$file);
		$ext = end($exploding);
		
		switch($ext){
			case "png":
				$src = imagecreatefrompng($file);
			break;
			case "jpeg":
			case "jpg":
				$src = imagecreatefromjpeg($file);
			break;
			case "gif":
				$src = imagecreatefromgif($file);
			break;
			default:
				$src = imagecreatefromjpeg($file);
			break;
		}
		
		$dst = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		switch($ext){
			case "png":
				imagepng($dst, $destination);
			break;
			case "jpeg":
			case "jpg":
				imagejpeg($dst, $destination);
			break;
			case "gif":
				imagegif($dst, $destination);
			break;
			default:
				imagejpeg($dst, $destination);
			break;
		}
		imagedestroy($dst);
	}
}

if ( !function_exists('get_client_ip_env') ){
	function get_client_ip_env() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
	
		return $ipaddress;
	}
}

if ( !function_exists('getBrowser') ){
	function getBrowser() {
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
		// First get the platform?
		if ( preg_match('/linux/i', $u_agent) )
			$platform = 'linux';
		else if ( preg_match('/macintosh|mac os x/i', $u_agent) )
			$platform = 'mac';
		else if ( preg_match('/windows|win32/i', $u_agent) )
			$platform = 'windows';
		
		// Next get the name of the useragent yes seperately and for good reason
		if( preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent) ) {
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		else if ( preg_match('/Firefox/i',$u_agent) ) {
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		else if( preg_match('/Chrome/i',$u_agent) ) {
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		else if( preg_match('/Safari/i',$u_agent) ) {
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		else if( preg_match('/Opera/i',$u_agent) ) {
			$bname = 'Opera';
			$ub = "Opera";
		}
		else if( preg_match('/Netscape/i',$u_agent) ) {
			$bname = 'Netscape';
			$ub = "Netscape";
		}
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {}
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub))
				$version= $matches['version'][0];
			else
				$version= $matches['version'][1];
		}
		else
			$version= $matches['version'][0];
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	}
}