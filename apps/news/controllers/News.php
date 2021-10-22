<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Maha Andar
* @Module       : Maps - Restaurant
* @Type         : Controller
* @Date Create	: 17 May 2021
*
***/
class News extends SITE_Controller
{
    private $page_curr = "";
    function __construct(){
        parent::__construct();
        $this->fragment['site']['module'] = "news";
        $this->page_curr = "news";
        $this->load->model("news_model", "nod");
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
            base_url("assets/js/news/news").",".ENVIRONMENT.",1.3",
            base_url("assets/js/default").",".ENVIRONMENT.",1.3",
        ];
        $this->fragment['data']         = $this->nod->render();
        $this->fragment['page_nav']     = "news";
        $this->fragment['page_title']   = "News - Management";
        $this->fragment['page_curr']    = $this->page_curr;
        $this->fragment['pagename']     = "index";
        $this->load->view("main-site", $this->fragment);
    }
    function forms()
    {
        if ( !$this->hasLogin() )redirect("auth/signin");
        $id = "";
        if ( $_GET )
        {
            $id = $this->input->get("id");
            $cek = $this->nod->render($id);
            if ( !$cek ) redirect($this->page_curr);
            $this->fragment['data']             = $cek;
            // $this->fragment['data_facility']    = $this->nod->render_facility($id);
            // $this->fragment['data_certificate'] = $this->nod->render_certificate($id);
        }
        $this->fragment['site']['css'] = [
            "text/css,stylesheet,".base_url("assets/plugins/datatables/dataTables.bootstrap.min.css"),
        ];
        $this->fragment['site']['js'] = [
            base_url("assets/plugins/datatables/jquery.dataTables").",min,1.0.0",
            base_url("assets/plugins/datatables/dataTables.bootstrap").",min,1.0.0",
            base_url("assets/js/maps/res-form").",".ENVIRONMENT.",1.1",
            base_url("assets/js/view_image").",".ENVIRONMENT.",1.1",
        ];
        // $this->fragment['data_iso']     = $this->nod->render_iso(1);
        // $this->fragment['page_nav']     = "maps::news";
        $this->fragment['page_title']   = "News - Forms";
        $this->fragment['page_curr']    = $this->page_curr;
        $this->fragment['pagename']     = "forms";
        $this->load->view("main-site", $this->fragment);
    }
    function forms_save()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        $isnew      = TRUE;
        $userid     = $this->user->getId();
        $query_sel  = "";
        $id         = $this->input->post("id");
        $title      = $this->input->post("title"); #REQUIRED
        $desc       = $this->input->post("desc"); #REQUIRED
        $expired_at = $this->input->post("expired_at");

        $desc       = preg_replace('!\s+!', ' ', $desc);

        $filename   = "";
        $old_fname  = "";
        $allowed_ext= ["jpg", "jpeg"];
        
        if ( mempty($id) == FALSE )
        {
            $cek = $this->nod->render($id);
            if ( !$cek ){$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
            $isnew = FALSE;
            $arr_cek = json_encode($cek);
            $query_sel = $this->db->last_query();
            $query_sel .= "<br/>".$arr_cek;
            $old_fname = $cek[0]->image_news;
        }
        if ( mempty($title) ){$this->response['response'] = "Masukkan Judul.";echo json_encode($this->response);exit;}
        if ( strlen($title) > 75 ){$this->response['response'] = "Maksimal panjang judul adalah 75 karakter.";echo json_encode($this->response);exit;}
        if ( mempty($desc) ){$this->response['response'] = "Masukkan deskripsi.";echo json_encode($this->response);exit;}
        // if ( strlen($desc) > 200 ){$this->response['response'] = "Maksimal panjang deskripsi adalah 200 karakter.";echo json_encode($this->response);exit;}
        // if ( mempty($address) ){$this->response['response'] = "Masukkan alamat.";echo json_encode($this->response);exit;}
        // if ( strlen($address) > 200) {$this->response['response'] = "Maksimal panjang alamat adalah 200 karakter.";echo json_encode($this->response);exit;}
        // if ( mempty($duration) ){$this->response['response'] = "Masukkan jam operasional.";echo json_encode($this->response);exit;}
        // if ( strlen($duration) > 20) {$this->response['response'] = "Maksimal panjang jam operasional adalah 20 karakter.";echo json_encode($this->response);exit;}
        // if ( mempty($website) == FALSE ){if (strlen($website) > 100){$this->response['response'] = "Maksimal panjang nama website adalah 100 karakter.";echo json_encode($this->response);exit;}}
        // if ( mempty($phone1) == FALSE ){if (strlen($phone1) > 20){$this->response['response'] = "Maksimal panjang Telepon 1 adalah 20 karakter.";echo json_encode($this->response);exit;}}
        // if ( mempty($phone2) == FALSE ){if (strlen($phone2) > 20){$this->response['response'] = "Maksimal panjang Telepon 2 adalah 20 karakter.";echo json_encode($this->response);exit;}}
        // if ( mempty($latitude) ){$this->response['response'] = "Masukkan latitude";echo json_encode($this->response);exit;}
        // if ( strlen($latitude) > 100 ){$this->response['response'] = "Maksimal panjang latitude adalah 100 karakter.";echo json_encode($this->response);exit;}
        // if ( mempty($longitude) ){$this->response['response'] = "Masukkan longitude";echo json_encode($this->response);exit;}
        // if ( strlen($longitude) > 100 ){$this->response['response'] = "Maksimal panjang longitude adalah 100 karakter.";echo json_encode($this->response);exit;}

        #NANTI RUBAH LOKASI PATH
        if ( isset($_FILES['file']['name']) and empty($_FILES['file']['name']) == FALSE ):
            $target_dir = "./../assets_tbs/news";
            $target_file = $target_dir . "/" . basename($_FILES["file"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if ( !is_dir($target_dir) )
                mkdir($target_dir, 0777, true);
            else
                chmod($target_dir, 0777);
            if ( $_FILES['file']['size'] > (200*1024) ){$this->response['response'] = "Maksimal file size adalah 200 Kb.";echo json_encode($this->response);exit;}
            if ( !in_array($imageFileType, $allowed_ext) ){$this->response['response'] = "Hanya menerima file dengan ekstensi ".implode(", ", $allowed_ext).".";echo json_encode($this->response);exit;}
            
            $temp_name = strtolower( preg_replace("/(\W)+/", "-", $title) ).'-'.strtolower( preg_replace("/(\W)+/", "-", basename($_FILES["file"]["name"], ".".$imageFileType) ) ).'-'.time();
            $filename = $temp_name . "." . $imageFileType;
            $fileupload = $target_dir."/".$filename;
            if ( file_exists($fileupload) ){$this->response['response'] = "Nama file sudah ada.";echo json_encode($this->response);exit;}
            move_uploaded_file($_FILES['file']['tmp_name'], $fileupload);
            chmod($target_dir, 0755);
        endif;

        $data = [
            "title_news"        => $title,
            "description_news"  => $desc,
            "created_at"        => date("Y-m-d H:i:s"),
            "expired_at"        => empty($expired_at) ? NULL : date("Y-m-d H:i:s", strtotime($expired_at)),
            "create_user"       => $this->user->getId(),
            "is_delete"         => 1
        ];
        if ( mempty($filename) == FALSE )
        {
            $data['image_news']      = $filename;
        }
        
        if ( $isnew )
        {
            $data['created_at']  = date("Y-m-d H:i:s");
            $data['create_user'] = $this->user->getId();
            
            $id = $this->sitemodel->insertid("news", $data);
        }
        else
        {
            $data['updated_at'] = date("Y-m-d H:i:s");
            $this->sitemodel->update("news", $data, ["id_news"=>$id]);
        }

        #Save to Logger
        $last_query = empty($query_sel) ? "" : $query_sel."<br />" ;
        $last_query .= $this->db->last_query();

        $this->response['type'] = 'done';
        $this->response['response'] = ($isnew) ? "Berhasil menambahkan data." : "Berhasil merubah data.";
        $this->response['uri'] = base_url($this->page_curr);
        echo json_encode($this->response);
        exit;
    }

    function view_detail()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        
        $id                         = $this->input->post("id");
        $id                         = empty($id) ? "0" : $id;
        $cek                        = $this->nod->render($id);


        if ( !$cek ) {$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
        $this->response['type']                   = 'done';
        $this->response['data_news']               = $cek;
        echo json_encode($this->response);
        exit;
    }

    function remove()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        
        $id         = $this->input->post("id");
        $id         = empty($id) ? "0" : $id;
        $query_sel  = "";
        $cek        = $this->nod->render($id);

        if ( !$cek ) {$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
       
        $arr_cek    = json_encode($cek);
        $query_sel  = $this->db->last_query();
        $query_sel .= "<br/>".$arr_cek;

        $data = [
            "is_delete"     => "2"
        ];

        $this->sitemodel->update("news", $data, ["id_news"=>$id]);
        #Save to Logger
        $last_query  = empty($query_sel) ? "" : $query_sel."<br />";
        $last_query .= $this->db->last_query();

        $this->logger->setLogger("input", "Data News", $last_query);
        $this->response['type']     = 'done';
        $this->response['response'] = "Berhasil menghapus data.";
        echo json_encode($this->response);
        exit;
    }
}