<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: News Team
* @Module       : Config - User
* @Type         : Controller
* @Date Create	: 28 January 2021
*
***/
class Config_user extends SITE_Controller{
    private $page_curr = "";
    function __construct(){
        parent::__construct();
        $this->fragment['site']['module'] = "config-user";
        $this->page_curr = "user";
        $this->load->model("configuser_model", "mod");
    }
    function index()
    {
        if ( !$this->hasLogin() )redirect("auth/signin");
        $this->fragment['site']['css'] = [
            "text/css,stylesheet,".base_url("assets/plugins/datatables/dataTables.bootstrap.min.css"),
        ];
        $this->fragment['site']['js'] = [
            base_url("assets/plugins/datatables/jquery.dataTables").",min,1.0.0",
            base_url("assets/plugins/datatables/dataTables.bootstrap").",min,1.0.0",
            base_url("assets/js/config/user").",".ENVIRONMENT.",1.2",
        ];
        $this->fragment['data']             = $this->mod->render();
        $this->fragment['data_role']        = $this->data_role;
        $this->fragment['page_nav']         = "configs::user";
        $this->fragment['page_title']       = "Pengaturan - User";
        $this->fragment['page_curr']        = $this->page_curr;
        $this->fragment['pagename']         = "index";
        $this->load->view("main-site", $this->fragment);
    }

    function save()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        $isnew      = TRUE;
        $id         = $this->input->post("id");
        $name       = $this->input->post("name", TRUE);
        $username   = $this->input->post("username", TRUE);
        $level      = $this->input->post("level");
        $query_sel = "";
        if ( empty($id) == FALSE ){
            $cek = $this->mod->render($id);
            if ( !$cek ){$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
            $isnew = FALSE;
            $arr_cek = json_encode($cek);
            $query_sel = $this->db->last_query();
            $query_sel .= "<br/>".$arr_cek;
        }
        
        if ( mempty($name) ){$this->response['response'] = "Masukkan nama lengkap.";echo json_encode($this->response);exit;}
        if ( strlen($name) > 50 ){$this->response['response'] = "Maksimal panjang nama adalah 50 karakter.";echo json_encode($this->response);exit;}
        if ( mempty($username) ) {$this->response['response'] = "Masukkan username.";echo json_encode($this->response);exit;}
        if ( !ctype_alpha($username) ) {$this->response['response'] = "Username hanya berupa alphabet (a-zA-Z)";echo json_encode($this->response);exit;}
        $check_user = $this->mod->check_user($username, $isnew, $id);
        if ( !$check_user ){$this->response['response'] = "Username sudah ada.";echo json_encode($this->response);exit;}
        if ( in_array($level, $this->data_role) ) {$this->response['response'] = "Pilih level.";echo json_encode($this->response);exit;}
        $data = [
            "user_fname"     => $name,
            "user_name"     => $username,
            "role_id"       => $level,
            "cycle_date"    => date("Y-m-d H:i:s"),
            "cycle_user"    => $this->user->getId()
        ];
        if ( $isnew ){
            $data['user_pwd']    = password_hash("123456", PASSWORD_DEFAULT);
            $data['create_date'] = date("Y-m-d H:i:s");
            $data['create_user'] = $this->user->getId();
        }
        ($isnew) ? $this->sitemodel->insert("user", $data) : $this->sitemodel->update("user", $data, ["user_id"=>$id]);
        #Save to Logger
        $last_query = empty($query_sel) ? "" : $query_sel."<br />" ;
        $last_query .= $this->db->last_query();
        $this->logger->setLogger("input", "Pengaturan - User", $last_query);
        $this->response['type'] = 'done';
        $this->response['response'] = ($isnew) ? "Berhasil menambahkan data." : "Berhasil merubah data.";
        echo json_encode($this->response);
        exit;
    }

    function edit()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        $id = $this->input->post("id");
        $id = empty($id) ? "0" : $id;
        $cek = $this->mod->render($id);
        if ( !$cek ) {$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
        $this->response['type'] = 'done';
        $this->response['response'] = $cek;
        echo json_encode($this->response);
        exit;
    }

    function remove()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        $id = $this->input->post("id");
        $id = empty($id) ? "0" : $id;
        $query_sel = "";
        $cek = $this->mod->render($id);
        if ( !$cek ) {$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
        $arr_cek = json_encode($cek);
        $query_sel = $this->db->last_query();
        $query_sel .= "<br/>".$arr_cek;
        $data = [
            "user_status"   => "1",
            "cycle_date"    => date("Y-m-d H:i:s"),
            "cycle_user"    => $this->user->getId()
        ];
        $this->sitemodel->update("user", $data, ["user_id"=>$id]);
        #Save to Logger
        $last_query = empty($query_sel) ? "" : $query_sel."<br />";
        $last_query .= $this->db->last_query();
        $this->logger->setLogger("input", "Config - User", $last_query);
        $this->response['type'] = 'done';
        $this->response['response'] = "Berhasil menghapus data.";
        echo json_encode($this->response);
        exit;
    }
    function reset_password()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        $id = $this->input->post("id");
        $id = empty($id) ? "0" : $id;
        $query_sel = "";
        $cek = $this->mod->render($id);
        if ( !$cek ) {$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
        $arr_cek = json_encode($cek);
        $query_sel = $this->db->last_query();
        $query_sel .= "<br/>".$arr_cek;
        $data = [
            "user_pwd"      => password_hash("123456", PASSWORD_DEFAULT),
            "cycle_date"    => date("Y-m-d H:i:s"),
            "cycle_user"    => $this->user->getId()
        ];
        $this->sitemodel->update("user", $data, ["user_id"=>$id]);
        #Save to Logger
        $last_query = empty($query_sel) ? "" : $query_sel."<br />";
        $last_query .= $this->db->last_query();
        $this->logger->setLogger("input", "Config - User", $last_query);
        $this->response['type'] = 'done';
        $this->response['response'] = "Berhasil me-reset password.";
        echo json_encode($this->response);
        exit;
    }
}