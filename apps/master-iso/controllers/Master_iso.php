<?php defined('BASEPATH') OR exit("No direct script access allowed");
class Master_iso extends SITE_Controller
{
    private $page_curr = "";
    function __construct()
    {
        parent::__construct();
        $this->fragment['site']['module'] = "master-iso";
        $this->page_curr = "master-iso";
        $this->load->model("masteriso_model", "mod");
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
            base_url("assets/js/master/iso").",".ENVIRONMENT.",1.3",
        ];
        $this->fragment['data']             = $this->mod->render();
        $this->fragment['page_nav']         = "master::master-iso";
        $this->fragment['page_title']       = "Data ISO";
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
        $type       = $this->input->post("type");
        $query_sel = "";
        if ( empty($id) == FALSE ){
            $cek = $this->mod->render($id);
            if ( !$cek ){$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
            $isnew = FALSE;
            $arr_cek = json_encode($cek);
            $query_sel = $this->db->last_query();
            $query_sel .= "<br/>".$arr_cek;
        }
        
        if ( mempty($name) ){$this->response['response'] = "Masukkan nama ISO.";echo json_encode($this->response);exit;}
        if ( strlen($name) > 50 ){$this->response['response'] = "Maksimal panjang nama ISO adalah 50 karakter.";echo json_encode($this->response);exit;}
        if ( empty($type) ) {$this->response['response'] = "Harap pilih tipe ISO.";echo json_encode($this->response);exit;}
        $data = [
            "iso_name"      => $name,
            "iso_type"      => $type,
            "cycle_date"    => date("Y-m-d H:i:s"),
            "cycle_user"    => $this->user->getId()
        ];
        if ( $isnew ){
            $data['create_date'] = date("Y-m-d H:i:s");
            $data['create_user'] = $this->user->getId();
        }
        ($isnew) ? $this->sitemodel->insert("iso", $data) : $this->sitemodel->update("iso", $data, ["iso_id"=>$id]);
        #Save to Logger
        $last_query = empty($query_sel) ? "" : $query_sel."<br />" ;
        $last_query .= $this->db->last_query();
        $this->logger->setLogger("input", "Master - Data ISO", $last_query);
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
            "iso_status"    => "1",
            "cycle_date"    => date("Y-m-d H:i:s"),
            "cycle_user"    => $this->user->getId()
        ];
        $this->sitemodel->update("iso", $data, ["iso_id"=>$id]);
        #Save to Logger
        $last_query = empty($query_sel) ? "" : $query_sel."<br />";
        $last_query .= $this->db->last_query();
        $this->logger->setLogger("input", "Master - Data ISO", $last_query);
        $this->response['type'] = 'done';
        $this->response['response'] = "Berhasil menghapus data.";
        echo json_encode($this->response);
        exit;
    }
}