<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Maha Andar
* @Module       : Maps - Restaurant
* @Type         : Model
* @Date Create	: 17 May 2021
*
***/
class News_model extends CI_Model
{
    function render($news_id=0)
    {
        $this->db->select("*");
        // $this->db->where("country_id", "1");
        $this->db->where("is_delete", "1");
        // $this->db->where("catmap_id", "1");
        if ( mempty($news_id) == FALSE )
            $this->db->where("id_news", $news_id);
            $this->db->order_by("id_news", "DESC");
        $q = $this->db->get("news");
        return ($q->num_rows() == 0 ? FALSE : $q->result());
    }
    // function render($map_id=0)
    // {
    //     $this->db->select("*");
    //     $this->db->where("country_id", "1");
    //     $this->db->where("status", "1");
    //     $this->db->where("catmap_id", "1");
    //     if ( mempty($map_id) == FALSE )
    //         $this->db->where("map_id", $map_id);
    //         $this->db->order_by("map_id", "DESC");
    //     $q = $this->db->get("map");
    //     return ($q->num_rows() == 0 ? FALSE : $q->result());
    // }
    // function render_facility($map_id=0)
    // {
    //     $this->db->select("facility_num");
    //     $this->db->where("famap_id", $map_id);
    //     $q = $this->db->get("facility");
    //     return ($q->num_rows() == 0 ? FALSE : $q->result());
    // }
    // function render_certificate($map_id=0)
    // {
    //     $this->db->select("cert_name,cert_exp,cert_file,iso_id");
    //     $this->db->where("famap_id", $map_id);
    //     $q = $this->db->get("certificate");
    //     return ($q->num_rows() == 0 ? FALSE : $q->result());
    // }
    // function render_map($cmid=0,$ctid=1)
    // {
    //     $this->db->select("map_id,catmap_id,name,rating,review,body,location,duration,phone1,phone2,photo,latitude,longitude");
    //     $this->db->where("country_id", $ctid);
    //     $this->db->where("catmap_id", $cmid);
    //     $this->db->where("status", 1);
    //     $q = $this->db->get("map");
    //     return ($q->num_rows() == 0 ? FALSE : $q->result());
    // }
    // function render_iso($iso_type=1)
    // {
    //     $this->db->select("iso_id,iso_name");
    //     $this->db->where("iso_status", "0");
    //     $this->db->where("iso_type", $iso_type);
    //     $q = $this->db->get("iso");
    //     return ($q->num_rows() == 0 ? FALSE : $q->result());
    // }
    // function render_certificate_and_iso($famap_id)
    // {
    //     $this->db->where("famap_id", $famap_id);
    //     $this->db->where("iso_status", 0); //Active
    //     $q = $this->db->get("iso_view");
    //     return ($q->num_rows() == 0 ? FALSE : $q->result());
    // }
    // function render_map_name($map_name)
    // {
    //     $this->db->select("name");
    //     $this->db->where("name", $map_name);
    //     $this->db->where("status", 1);
    //     $q = $this->db->get("map");
    //     return ($q->num_rows() == 0 ? FALSE : $q->result());
    // }

    // function render_map_name_edit($map_name, $map_id=0)
    // {
    //     $this->db->select("name");
    //     $this->db->where("name", $map_name);
    //     $this->db->where("map_id", $map_id);
    //     $this->db->where("status", 1);
    //     $q = $this->db->get("map");
    //     return ($q->num_rows() == 0 ? FALSE : $q->result());
    // }


}