<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: News Team
* @Module       : Site
* @Type         : Controller
* @Date Create	: 28 January 2021
*
***/
class Site extends SITE_Controller{
	function __construct(){
		parent::__construct();
		$this->fragment['site']['module'] = "site";
		$this->load->model("Security_model", "sec");
	}

	function index(){
		if ( !$this->hasLogin() )redirect("auth/signin");
		$this->load->model("site_model", "mod");
		$this->fragment['site']['css'] = [
			"text/css,stylesheet,".base_url("assets/plugins/datatables/dataTables.bootstrap.min.css"),
		];
		$this->fragment['site']['js'] = [
			base_url("assets/plugins/datatables/jquery.dataTables").",min,1.0.0",
			base_url("assets/plugins/datatables/dataTables.bootstrap").",min,1.0.0",
			// base_url("assets/js/dashboard").",".ENVIRONMENT.",1.3",
		];
		$pagename = "index-master";
		$this->fragment['page_title'] 		= "Dashboard";
        $this->fragment['page_nav']     	= "dashboard";
		$this->fragment['pagename'] 		= $pagename;
		$this->load->view("main-site", $this->fragment);
	}

	#View Login
	function login(){
		if ( $this->hasLogin() )redirect();
		$this->fragment['page_title'] = "Sign In";
		$this->load->view("auth/index", $this->fragment);
	}

	#Process Logout
	function logout(){
		if ( ! $this->hasLogin() )redirect();
		$this->session->sess_destroy();
		redirect("auth/signin");
	}

	#Ajax Login
	function proc_login(){
		if ( $this->hasLogin() ){
			$this->response['response'] = "Sesi anda belum berakhir.";
			echo json_encode($this->response);
			exit;
		}

		$username = $this->input->post("username");
		$passwd = $this->input->post("passwd");
		if ( mempty($username) ){$this->response['response'] = "Masukkan nama pengguna.";echo json_encode($this->response);exit;}
		if ( mempty($passwd) ){$this->response['response'] = "Masukkan kata sandi";echo json_encode($this->response);exit;}
		$this->load->model("security_model", "security");
		$cek = $this->security->check($username);
		if ( !$cek ){$this->response['response'] = "Nama pengguna / kata sandi salah.";echo json_encode($this->response);exit;}
		$foto = base_url("assets/images/default.jpg");
		$data = [
			"id"		=> $cek[0]->user_id,
			"name"		=> empty($cek[0]->user_fname) ? $cek[0]->user_name : $cek[0]->user_fname,
			"role"		=> $cek[0]->role_id,
			"access"	=> $this->map_access($cek[0]->role_id),
			"user"		=> $cek[0]->user_name,
			"photo"		=> $foto,
		];
		$pwd = $cek[0]->user_pwd;
		if ( !password_verify($passwd, $pwd) ){
			#Save to Logger
			$this->logger->setLogger("login", $username, "Failed Login", "0", "1");
			$this->response['response'] = "Nama pengguna / kata sandi salah.";
			echo json_encode($this->response);
			exit;
		}
		$this->session->set_userdata(SESS, (object)$data);
		#Save to Logger
		$this->logger->setLogger("login", $cek[0]->user_id, "Success Login", "0", "0");
		$this->response['type'] = 'done';
		$this->response['response'] = "";
		echo json_encode($this->response);
		exit;
	}

	#Ajax Change password
	function form_cpass(){
		if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
		if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
		$opwd = $this->input->post("opwd");
		$npwd = $this->input->post("npwd");
		$cpwd = $this->input->post("cpwd");
		if ( mempty($opwd) ){$this->response['response'] = "Masukkan kata sandi lama";echo json_encode($this->response);exit;}
		$this->load->model("security_model", "security");
		$cek = $this->security->check($this->user->getUser());
		if ( !$cek ){$this->response['response'] = "User tidak ditemukan.";echo json_encode($this->response);exit;}
		$curr_pwd = $cek[0]->user_pwd;
		if ( !password_verify($opwd, $curr_pwd) ){$this->response['response'] = "Kata sandi lama salah.";echo json_encode($this->response);exit;}
		if ( mempty($npwd) ){$this->response['response'] = "Masukkan kata sandi baru";echo json_encode($this->resposne);exit;}
		if ( strlen($npwd) < 6 or strlen($npwd) > 50 ){$this->response['response'] = "Panjang kata sandi baru harus berada diantara 6 dan 50 karakter.";echo json_encode($this->response);exit;}
		if ( $cpwd != $npwd ){$this->response['response'] = "Kata sandi baru dan konfirmasi tidak sama.";echo json_encode($this->response);exit;}
		$data =[
			"user_pwd"		=> password_hash($npwd, PASSWORD_DEFAULT),
			"cycle_date"	=> date("Y-m-d H:i:s"),
			"cycle_user"	=> $this->user->getId()
		];
		$this->sitemodel->update("user", $data, ["user_id"=>$this->user->getId()]);
		$this->response['type'] = 'done';
		$this->response['response'] = "Berhasil merubah kata sandi.";
		echo json_encode($this->response);
		exit;
	}
}