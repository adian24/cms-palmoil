<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Maha Andar
* @Module       : Maps - Hotel
* @Type         : Controller
* @Date Create	: 17 May 2021
*
***/
class Maps_hotel extends SITE_Controller
{
    private $page_curr = "";
    function __construct(){
        parent::__construct();
        $this->fragment['site']['module'] = "maps-hotel";
        $this->page_curr = "maps-hotel";
        $this->load->model("mapshotel_model", "mod");
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
            base_url("assets/js/maps/hotel").",".ENVIRONMENT.",1.3",
        ];
        $this->fragment['data']         = $this->mod->render();
        $this->fragment['page_nav']     = "maps::maps-hotel";
        $this->fragment['page_title']   = "Maps - Hotel";
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
            $cek = $this->mod->render($id);
            if ( !$cek ) redirect($this->page_curr);
            $this->fragment['data'] = $cek;
            $this->fragment['data_facility'] = $this->mod->render_facility($id);
            $this->fragment['data_certificate'] = $this->mod->render_certificate($id);
        }
        $this->fragment['site']['css'] = [
            "text/css,stylesheet,".base_url("assets/plugins/datatables/dataTables.bootstrap.min.css"),
        ];
        $this->fragment['site']['js'] = [
            base_url("assets/plugins/datatables/jquery.dataTables").",min,1.0.0",
            base_url("assets/plugins/datatables/dataTables.bootstrap").",min,1.0.0",
            base_url("assets/js/maps/hotel-form").",".ENVIRONMENT.",1.1",
            base_url("assets/js/view_image").",".ENVIRONMENT.",1.1",
        ];
        $this->fragment['data_iso']     = $this->mod->render_iso(2);
        $this->fragment['page_nav']     = "maps::maps-hotel";
        $this->fragment['page_title']   = "Maps Hotel - Forms";
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
        $address    = $this->input->post("address"); #REQUIRED
        $duration   = $this->input->post("duration"); #REQUIRED
        $website    = $this->input->post("website");
        $phone1     = $this->input->post("phone1");
        $phone2     = $this->input->post("phone2");
        $latitude   = $this->input->post("latitude");
        $longitude  = $this->input->post("longitude");

        #Facility
        $facility   = $this->input->post("facility");

        #Certificate
        $cert_name  = $this->input->post("cert_name");
        $cert_year  = $this->input->post("cert_year");
        $cert_iso   = $this->input->post("cert_iso");
        $cert_file  = $this->input->post("cert_file");
        $cert_oldfile = $this->input->post("cert_oldfile");

        $desc       = preg_replace('!\s+!', ' ', $desc);

        $filename   = "";
        $old_fname  = "";
        $allowed_ext= ["jpg", "jpeg"];
        
        if ( mempty($id) == FALSE )
        {
            $cek = $this->mod->render($id);
            if ( !$cek ){$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
            $isnew = FALSE;
            $arr_cek = json_encode($cek);
            $query_sel = $this->db->last_query();
            $query_sel .= "<br/>".$arr_cek;
            $old_fname = $cek[0]->photo;
        }
        if ( mempty($title) ){$this->response['response'] = "Masukkan Nama.";echo json_encode($this->response);exit;}
        if ( strlen($title) > 75 ){$this->response['response'] = "Maksimal panjang nama adalah 75 karakter.";echo json_encode($this->response);exit;}
        if ( mempty($desc) ){$this->response['response'] = "Masukkan deskripsi.";echo json_encode($this->response);exit;}
        if ( strlen($desc) > 200 ){$this->response['response'] = "Maksimal panjang deskripsi adalah 200 karakter.";echo json_encode($this->response);exit;}
        if ( mempty($address) ){$this->response['response'] = "Masukkan alamat.";echo json_encode($this->response);exit;}
        if ( strlen($address) > 200) {$this->response['response'] = "Maksimal panjang alamat adalah 200 karakter.";echo json_encode($this->response);exit;}
        // if ( mempty($duration) ){$this->response['response'] = "Masukkan jam operasional.";echo json_encode($this->response);exit;}
        if ( strlen($duration) > 20) {$this->response['response'] = "Maksimal panjang jam operasional adalah 20 karakter.";echo json_encode($this->response);exit;}
        if ( mempty($website) == FALSE ){if (strlen($website) > 100){$this->response['response'] = "Maksimal panjang nama website adalah 100 karakter.";echo json_encode($this->response);exit;}}
        if ( mempty($phone1) == FALSE ){if (strlen($phone1) > 20){$this->response['response'] = "Maksimal panjang Telepon 1 adalah 20 karakter.";echo json_encode($this->response);exit;}}
        if ( mempty($phone2) == FALSE ){if (strlen($phone2) > 20){$this->response['response'] = "Maksimal panjang Telepon 2 adalah 20 karakter.";echo json_encode($this->response);exit;}}
        if ( mempty($latitude) ){$this->response['response'] = "Masukkan latitude";echo json_encode($this->response);exit;}
        if ( strlen($latitude) > 100 ){$this->response['response'] = "Maksimal panjang latitude adalah 100 karakter.";echo json_encode($this->response);exit;}
        if ( mempty($longitude) ){$this->response['response'] = "Masukkan longitude";echo json_encode($this->response);exit;}
        if ( strlen($longitude) > 100 ){$this->response['response'] = "Maksimal panjang longitude adalah 100 karakter.";echo json_encode($this->response);exit;}

        #NANTI RUBAH LOKASI PATH
        if ( isset($_FILES['file']['name']) and empty($_FILES['file']['name']) == FALSE ):
            $target_dir = "./../assets/hotel";
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

        $cek_map_name          = $this->mod->render_map_name($title);
        $cek_map_name_for_edit = $this->mod->render_map_name_edit($title,$id);

        $data = [
            "catmap_id"         => 2,
            "name"              => $title,
            "body"              => $desc,
            "location"          => $address,
            "duration"          => $duration,
            "website"           => mempty($website) ? NULL : $website,
            "phone1"            => mempty($phone1) ? NULL : $phone1,
            "phone2"            => mempty($phone2) ? NULL : $phone2,
            "latitude"          => $latitude,
            "longitude"         => $longitude,
            "cycle_date"        => date("Y-m-d H:i:s"),
            "cycle_user"        => $this->user->getId()
        ];
        
        if ( mempty($filename) == FALSE )
        {
            $data['photo']      = $filename;
        }


        if ( $isnew )
        {
            if (empty($cek_map_name)){
                $data['create_date'] = date("Y-m-d H:i:s");
                $data['create_user'] = $this->user->getId();
                
                $id = $this->sitemodel->insertid("map", $data);
            }
        }
        else
        {
            if ($isnew == FALSE && !empty($cek_map_name_for_edit) || $isnew == FALSE && empty($cek_map_name)){
                $this->sitemodel->update("map", $data, ["map_id"=>$id]);
            }
        }

        #Save to Logger
        $last_query = empty($query_sel) ? "" : $query_sel."<br />" ;
        $last_query .= $this->db->last_query();

        #Delete Facility Data based on Map Id and recreate the data based on Input
        $this->sitemodel->delete("facility", ["famap_id" => $id]);
        if ( empty($facility) == FALSE )
        {
            for($i = 0; $i < count($facility); $i++):
                $data_facility = [
                    "famap_id"      => $id,
                    "facility_num"  => $facility[$i],
                    "create_date"   => date("Y-m-d H:i:s"),
                    "create_user"   => $userid
                ];
                $this->sitemodel->insert("facility", $data_facility);
            endfor;
        }

        #Delete Certificate Data based on Map ID and recreate the data based on Input
        $this->sitemodel->delete("certificate", ["famap_id" => $id]);
        if ( empty($cert_name) == FALSE )
        {
            for($i = 0; $i < count($cert_name); $i++):
                $cert_filename = "";
                if ( isset($_FILES['cert_file']['name'][$i]) and empty($_FILES['cert_file']['name'][$i]) == FALSE ):
                    $target_dir = "./../assets/certificate";
                    $target_file = $target_dir . "/" . basename($_FILES['cert_file']["name"][$i]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    if ( !is_dir($target_dir) )
                        mkdir($target_dir, 0777, true);
                    else
                        chmod($target_dir, 0777);
                    if ( $_FILES['cert_file']['size'][$i] > (200*1024) ){$this->response['response'] = "Maksimal file size adalah 200 Kb.";echo json_encode($this->response);exit;}
                    if ( !in_array($imageFileType, $allowed_ext) ){$this->response['response'] = "Hanya menerima file dengan ekstensi ".implode(", ", $allowed_ext).".";echo json_encode($this->response);exit;}
                    
                    $temp_name = strtolower( preg_replace("/(\W)+/", "-", basename($_FILES['cert_file']["name"][$i], ".".$imageFileType) ) ).'-'.time();
                    $cert_filename = strtolower( preg_replace("/(\W)+/", "-", $title) ).'-'.$temp_name . "." . $imageFileType;
                    $fileupload = $target_dir."/".$cert_filename;
                    if ( file_exists($fileupload) ){$this->response['response'] = "Nama file sudah ada.";echo json_encode($this->response);exit;}
                    move_uploaded_file($_FILES['cert_file']['tmp_name'][$i], $fileupload);
                    chmod($target_dir, 0755);
                endif;
                #If Empty then get data from old data (case of edit)
                if ( mempty($cert_filename) )
                {
                    $cert_filename = $cert_oldfile[$i];
                }
                if ( mempty($cert_name[$i]) == FALSE and mempty($cert_year[$i]) == FALSE and mempty($cert_filename) == FALSE ):
                    $data_cert = [
                        "famap_id"      => $id,
                        "cert_name"     => $cert_name[$i],
                        "cert_exp"      => $cert_year[$i],
                        "iso_id"        => mempty($cert_iso[$i]) ? 0 : $cert_iso[$i],
                        "cert_file"     => $cert_filename,
                        "create_date"   => date("Y-m-d H:i:s"),
                        "create_user"   => $userid
                    ];
                    $this->sitemodel->insert("certificate", $data_cert);
                endif;
            endfor;
        }
        
        #CREATE CACHE FOR MAPS
        $json_loc = "./../".API_FOLDER."/jscache/cmap_2.json";
        $data_save = $this->mod->render_map(2);
        if ( $data_save )
        {
            foreach($data_save as $t)
            {
                $temp_photo = ASSET_URL."hotel/".$t->photo;
                $t->photo = $temp_photo;
                $grab_facility = $this->mod->render_facility($t->map_id);
                if ( $grab_facility )
                {
                    $temp_facility = [];
                    foreach($grab_facility as $tt):
                        $v_fac = ASSET_URL."facility/".$this->facility_arr[$tt->facility_num];
                        array_push($temp_facility, $v_fac);
                    endforeach;
                    $t->facility = $temp_facility;
                }
                else
                    $t->facility = [];
            }

            $json_save = json_encode($data_save);
            file_put_contents($json_loc, $json_save); #Save to Category MAP
        }

        if ($isnew == TRUE && empty($cek_map_name)){
            $this->response['type']     = 'done';
            $this->response['response'] = "Berhasil menambahkan data.";
            $this->response['uri']      = base_url($this->page_curr);
            echo json_encode($this->response);
            exit;
        }elseif($isnew == FALSE && !empty($cek_map_name_for_edit) && $cek_map_name_for_edit[0]->name == $title){
            $this->response['type']     = 'done';
            $this->response['response'] = "Berhasil merubah data.";
            $this->response['uri']      = base_url($this->page_curr);
            echo json_encode($this->response);
            exit;
        }elseif($isnew == FALSE && empty($cek_map_name)){
            $this->response['type']     = 'done';
            $this->response['response'] = "Berhasil merubah data.";
            $this->response['uri']      = base_url($this->page_curr);
            echo json_encode($this->response);
            exit;
        
        }else{
            $this->response['type']     = 'gagal';
            $this->response['response'] = "<b>Nama Hotel</b> sudah ada, Harap masukan <b>Nama</b> yang berbeda!.";
            $this->response['uri']      = base_url($this->page_curr);
            echo json_encode($this->response);
            exit;
        }

        // $this->response['type'] = 'done';
        // $this->response['response'] = ($isnew) ? "Berhasil menambahkan data." : "Berhasil merubah data.";
        // $this->response['uri'] = base_url($this->page_curr);
        // echo json_encode($this->response);
        // exit;
    }

    function view_detail()
    {
        if ( !$this->hasLogin() ){$this->response['response'] = "Sesi anda berakhir, harap login kembali.";echo json_encode($this->response);exit;}
        if ( !$_POST ){$this->response['response'] = "Parameter salah.";echo json_encode($this->response);exit;}
        
        $id                         = $this->input->post("id");
        $id                         = empty($id) ? "0" : $id;
        $cek                        = $this->mod->render($id);
        $data_certificate_and_iso   = $this->mod->render_certificate_and_iso($id);
        $data_facility              = $this->mod->render_facility($id);
        $facility_arr = [
            "1" => "Wifi",
            "2" => "Toilet",
            "3" => "Tempat Parkir",
            "4" => "Musholla"
        ];

        if ( !$cek ) {$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
        $this->response['type']                     = 'done';
        $this->response['data_map']                 = $cek;
        $this->response['data_certificate_and_iso'] = !empty($data_certificate_and_iso) ? $data_certificate_and_iso : '';
        $this->response['data_facility']            = !empty($data_facility) ? $data_facility : '';
        $this->response['facility_arr']             = $facility_arr;
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
        $cek        = $this->mod->render($id);

        if ( !$cek ) {$this->response['response'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
       
        $arr_cek    = json_encode($cek);
        $query_sel  = $this->db->last_query();
        $query_sel .= "<br/>".$arr_cek;

        $data = [
            "status"        => "2",
            "cycle_date"    => date("Y-m-d H:i:s"),
            "cycle_user"    => $this->user->getId()
        ];

        $this->sitemodel->update("map", $data, ["map_id"=>$id]);
        #Save to Logger
        $last_query  = empty($query_sel) ? "" : $query_sel."<br />";
        $last_query .= $this->db->last_query();

        $this->logger->setLogger("input", "Data Map", $last_query);
        $this->response['type']     = 'done';
        $this->response['response'] = "Berhasil menghapus data.";
        echo json_encode($this->response);
        exit;
    }
}