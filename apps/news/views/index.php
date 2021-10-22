<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Maha Andar
* @Module       : Maps Restaurant
* @Type         : View
* @Date Create	: 17 May 2021
*
***/
// $facility_arr = [
//     "1" => "Wifi",
//     "2" => "Toilet",
//     "3" => "Tempat Parkir",
//     "4" => "Musholla"
// ];
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title mt-5"><?=$page_title?></h3>
                <a href="<?=base_url("{$page_curr}/forms")?>" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i></a>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table id="dt" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px;">NO</th>
                                    <th class="text-center" style="width: 50ex;">Judul</th>
                                    <th class="text-center" style="max-width: 20ex;">Expired Date</th>
                                    <th class="text-center" style="max-width: 20ex;">Status</th>
                                    <th class="text-center" style="max-width: 10ex;"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            if ( isset($data) and $data ):
                                foreach($data as $t):
                                    // echo "<pre>";
                                    // print_r($t);
                                    // $phone    = empty($t->phone1) ? "-" : $t->phone1;
                                    // $phone   .= empty($t->phone2) ? " / -" : " / ".$t->phone2;
                                    // $duration = empty($t->duration) ? "-" : $t->duration;
                            ?>
                                <tr>
                                    <td class="text-center"><?=$no?></td>
                                    <td><?=$t->title_news?></td>
                                    <td class="text-center"><?= !empty($t->expired_at) ? date('d F Y', strtotime($t->expired_at)) : '-' ?></td>
                                    <td class="text-center">
                                        <?php 
                                            $date_today   = date('Y-m-d');
                                            $date_expired = date('Y-m-d', strtotime($t->expired_at));
                                            if($t->expired_at == NULL || $date_today <= $date_expired){
                                        ?>
                                            <!-- <button class="btn btn-outline" title="News masih aktif dan di tampilkan di front end." style="width: 10ex;">Active</button> -->
                                                <span title="News masih aktif dan di tampilkan di front end." style="color:green"><b>ACTIVE</b></span>
                                        <?php }else{ ?>

                                            <!-- <button class="btn btn-danger" title="News sudah tidak aktif dan tidak di tampilkan di front end." style="width: 10ex;">Expired</button> -->
                                            <span title="News sudah tidak aktif dan tidak di tampilkan di front end." style="color:red"><b>EXPIRED</b></span>

                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary btn-view-detail mr-5" data-id="<?=$t->id_news?>" data-uri="<?=base_url("{$page_curr}/view")?>" title="Ubah Data"><i class="fa fa-eye"></i></button>
                                        <a class="btn btn-sm btn-warning btn-edit mr-5" href="<?=base_url("{$page_curr}/forms?id=".$t->id_news)?>" title="Ubah Data"><i class="fa fa-edit"></i></a> 
                                        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?=$t->id_news?>" data-name="<?=$t->title_news?>" data-uri="<?=base_url("{$page_curr}/dels")?>" title="Hapus Data"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                                endforeach;
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="modal-default" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">×</button>
                <h4 class="modal-title strong"><?=$page_title?> Detail</h4>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12" style="font-size: 3ex;">
                        <i class="fa fa-info text-center" style="background: #0095ff; width:2ex; color:white; border-radius:5px"></i> <label>Informasi</label>
                    </div>
                </div>
                <hr style="margin: revert;"/>

                <div class="row clearfix">
                    <div class="col-md-12 form-group" style="align-items: center; display:grid">
                        <!-- <label>Photo : </label> -->
                        <div class="input-group" id="image_news">
                           
                        </div>
                    </div>                      
                </div>

                <div class="row clearfix">
                    <div class="col-md-6 form-group">
                        <label>Judul : </label>
                        <div class="input-group">
                            <span id="title"></span>
                        </div>
                    </div>
                
                    <div class="col-md-6 form-group">
                        <label>Expired Date : </label>
                        <div class="input-group">
                            <span id="expired_at"></span>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-md-12 form-group">
                        <label>Deskripsi : </label>
                        <div class="input-group text-justify">
                            <span id="desc"></span>
                        </div>
                    </div>                                               
                </div>

            </div>
        </div>
    </div>
</div>
