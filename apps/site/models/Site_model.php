<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: News Team
* @Module       : Site - Model
* @Type         : Model
* @Date Create	: 29 Maret 2021
*
***/
class Site_model extends CI_Model{
    function render_totalarticle($month="0", $year="0")
    {
        $sql = "SELECT DATE_FORMAT(art_pubtime, '%d %M %Y') as date_time, COUNT(art_id) as total_article
        FROM t_article
        WHERE 
        art_status = 1 AND 
        art_pubtime IS NOT NULL AND 
        DATE_FORMAT(art_pubtime, '%m') = ? AND
        DATE_FORMAT(art_pubtime, '%Y') = ?
        GROUP BY DATE_FORMAT(art_pubtime, '%d %M %Y')
        ORDER BY art_pubtime DESC";
        $q = $this->db->query($sql, [$month, $year]);
        return ($q->num_rows() == 0 ? FALSE : $q->result());
    }
    function render_rankalexa($month="0", $year="0")
    {
        $sql = "SELECT DATE_FORMAT(alexa_date, '%d %M %Y') as alexa_date, rank_global, rank_country
        FROM t_alexa_rank
        WHERE
        DATE_FORMAT(alexa_date, '%m') = ? AND
        DATE_FORMAT(alexa_date, '%Y') = ?
        ORDER BY alexa_date DESC";
        $q = $this->db->query($sql, [$month, $year]);
        return ($q->num_rows() == 0 ? FALSE : $q->result());
    }
    function render_gapageview($month="0", $year="0")
    {
        $sql = "SELECT DATE_FORMAT(ap_date, '%d %M %Y') as ap_date, total_pageview
        FROM t_analytics_pageview
        WHERE
        DATE_FORMAT(ap_date, '%m') = ? AND
        DATE_FORMAT(ap_date, '%Y') = ?
        ORDER BY ap_date DESC";
        $q = $this->db->query($sql, [$month, $year]);
        return ($q->num_rows() == 0 ? FALSE : $q->result());
    }
}