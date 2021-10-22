<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Ryan Irsandi
* @Module       : Company
* @Type         : View
* @Date Create	: 23 April 2019
* @Date Revise	: 24 April 2019
* @Version		: 1.0.1
* @Notes		:	+ Initial Commit
                    (Version 1.0.1) - 02 January 2019
                    + Fixing bug when editing user access
*
***/
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title mt-5"><?=$page_title?></h3>
                <a href="javascript:;" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#modal-default" data-keyboard="false" data-backdrop="static"><i class="fa fa-plus"></i></a>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table id="dt" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Nama</th>
                                    <th>Level</th>
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($data) and $data){
                                foreach($data as $t){
                                    $warehouse_name = empty($t->warehouse_name) ? "-" : $t->warehouse_name;
                                    $warehouse_name .= (empty($t->status) ? "" : " <span class=\"text-red italic\">(Data Gudang sudah di hapus)</span>");
                            ?>
                                <tr>
                                    <td class="fit">#<?=$t->user_id?></td>
                                    <td><?=$t->user_name?></td>
                                    <td><?=$t->user_fname?></td>
                                    <td><?=$data_role[$t->role_id]?></td>
                                    <td class="fit">
                                        <button type="button" class="btn btn-sm btn-success btn-reset-pwd mr-5" data-name="<?=$t->user_fname?>" data-id="<?=$t->user_id?>" data-uri="<?=base_url("{$page_curr}/reset-password")?>" title="Reset Password"><i class="fa fa-key"></i></button>
                                        <button type="button" class="btn btn-sm btn-warning btn-edit mr-5" data-id="<?=$t->user_id?>" data-uri="<?=base_url("{$page_curr}/edit")?>" title="Ubah Data"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?=$t->user_id?>" data-name="<?=$t->user_fname?>" data-uri="<?=base_url("{$page_curr}/dels")?>" title="Hapus Data"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>
                            <?php
                                }
                            }
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
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url("{$page_curr}/save")?>" method="POST" id="form-default" accept-charset="UTF-8">
                <div class="modal-header">
                    <button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">×</button>
                    <h4 class="modal-title strong"><?=$page_title?></h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-6 form-group">
                            <label>Nama Lengkap <span class="text-red">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-file-text text-blue"></i></span>
                                <input type="text" name="name" id="name" maxlength="50" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Username <span class="text-red">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-file-text text-blue"></i></span>
                                <input type="text" name="username" id="username" maxlength="30" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Level</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check text-blue"></i></span>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="">- Pilih Level -</option>
                                    <?php
                                    if ( isset($data_role) and $data_role ):
                                        foreach($data_role as $key=>$val):
                                            echo "<option value=\"{$key}\">{$val}</option>";
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <span class="text-red italic text-bold">
                                * default password saat menambahkan user adalah : 123456
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="collapse" id="id" name="id" />
                    <div class="info-modal callout callout-warning text-center">Harap isi semua yang bertanda *</div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>	