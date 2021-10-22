<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Maha Andar
* @Module       : Maps Company
* @Type         : View
* @Date Create	: 17 May 2021
*
***/
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
                        <table id="dt" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">Perusahaan</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Jam Operasional</th>
                                    <th class="text-center">Telepon</th>
                                    <th class="text-center" style="width: 100px !important;"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            if ( isset($data) and $data ):
                                foreach($data as $t):
                                    $phone    = empty($t->phone1) ? "-" : $t->phone1;
                                    $phone   .= empty($t->phone2) ? " / -" : " / ".$t->phone2;
                                    $duration = empty($t->duration) ? "-" : $t->duration;
                            ?>
                                <tr>
                                    <td><?=$no?></td>
                                    <td><?=$t->name?></td>
                                    <td><?=$t->location?></td>
                                    <td><?=$duration?></td>
                                    <td><?=$phone?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary btn-view-detail mr-5" data-id="<?=$t->map_id?>" data-uri="<?=base_url("{$page_curr}/view")?>" title="Ubah Data"><i class="fa fa-eye"></i></button>
                                        <a class="btn btn-sm btn-warning btn-edit mr-5" href="<?=base_url("{$page_curr}/forms?id=".$t->map_id)?>" title="Ubah Data"><i class="fa fa-edit"></i></a> 
                                        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?=$t->map_id?>" data-name="<?=$t->name?>" data-uri="<?=base_url("{$page_curr}/dels")?>" title="Hapus Data"><i class="fa fa-close"></i></button>
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
                        <div class="input-group" id="photo_company">
                           
                        </div>
                    </div>                      
                </div>

                <div class="row clearfix">
                    <div class="col-md-4 form-group">
                        <label>Nama Company : </label>
                        <div class="input-group">
                            <span id="name"></span>
                        </div>
                    </div>
                
                    <div class="col-md-4 form-group">
                        <label>Deskripsi : </label>
                        <div class="input-group">
                            <span id="desc"></span>
                        </div>
                    </div>                        
                        
                    <div class="col-md-4 form-group">
                        <label>Jam Oprational : </label>
                        <div class="input-group">
                            <span id="jam_oprational"></span>
                        </div>
                    </div>
                                            
                </div>

                <div class="row clearfix">
                    <div class="col-md-4 form-group">
                        <label>Website : </label>
                        <div class="input-group">
                            <b><a href="" id="website" target="_blank"></a></b>
                        </div>
                    </div>                        
                
                    <div class="col-md-4 form-group">
                        <label>Telepon 1 : </label>
                        <div class="input-group">
                            <span id="phone1"></span>
                        </div>
                    </div>    
                    
                    <div class="col-md-4 form-group">
                        <label>Telepon 2 : </label>
                        <div class="input-group">
                            <span id="phone2"></span>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-md-4 form-group">
                        <label>Latitude : </label>
                        <div class="input-group">
                            <span id="latitude"></span>
                        </div>
                    </div>                        
                
                    <div class="col-md-4 form-group">
                        <label>Longitude : </label>
                        <div class="input-group">
                            <span id="longitude"></span>
                        </div>
                    </div>    
                    
                    <div class="col-md-4 form-group">
                        <label>Alamat : </label>
                        <div class="input-group">
                            <span id="alamat"></span>
                        </div>
                    </div> 
                </div>

                <div class="row clearfix">
                    <div class="col-md-12" style="font-size: 3ex;">
                        <i class="fa fa-file-text text-center" style="width:2ex; color:#0095ff"></i> <label>Sertifikasi</label>
                    </div>
                </div>
                <hr style="margin: revert;"/>

                <div class="row clearfix mb-5 pb-5">
                    <div class="col-md-12 sertifikat"></div>
                </div>

                <div class="row clearfix">
                    <div class="col-md-12" style="font-size: 3ex;">
                        <i class="fa fa-home text-center" style="width:2ex; color:#0095ff; font-size:3ex"></i> <label>Fasilitas</label>
                    </div>
                </div>
                <hr style="margin: revert;"/>

                <div class="row clearfix">
                    <div class="fasilitas"></div>
                </div>
            </div>
        </div>
    </div>
</div>
