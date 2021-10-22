<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: M. Maha Andar Pasaribu
* @Module       : Site
* @Type         : View
* @Date Create	: 03 September 2018
* @Date Revise	: 
* @Version		: 1.0.0
* @Notes		:	+ Initial Commit
*
***/
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row clearfix">
            <div class="col-md-6">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-thumb-tack"></i> Quick Access</h3>
                            </div>
                            <div class="box-body">
                                <div class="row clearfix">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <a class="btn btn-app btn-block">
                                            <i class="fa fa-calendar"></i> ???
                                        </a>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <a class="btn btn-app btn-block">
                                            <i class="fa fa-calendar-check-o"></i> ???
                                        </a>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <a class="btn btn-app btn-block">
                                            <i class="fa fa-calendar-check-o"></i> ???
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-bullhorn"></i> ??</h3>
                            </div>
                            <div class="box-body" style="height:500px;overflow:hidden;overflow-y:scroll;">
                            <!--
                                <ul style="margin:0">
                                    <?php 
                                        if ( isset($announc_data) and $announc_data ){
                                            $a = 1;
                                        foreach($announc_data as $t){
                                    ?>
                                    <li style="margin:10px 0 30px 0;">
                                        <div style="display:inline-block">
                                            <strong><?=$t->title?></strong>
                                        </div>
                                        <div style="display:inline-block;float:right;margin-right:25px;">
                                            <em><?=date("d F Y", strtotime($t->create_date))?></em>
                                        </div>
                                        <hr style="border: 1px solid maroon">
                                        <div style="margin-top:7px;"><?=$t->content?></div>
                                    </li>
                                    <?php } }else{ ?>
                                        <div style="padding: 35%;"><strong>Tidak ada pengumuman</strong></div>
                                    <?php } ?>
                                </ul>
                            -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-attend" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="form-default" accept-charset="UTF-8">
                <div class="modal-header">
                    <button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">×</button>
                    <h4 class="modal-title strong"><?=$page_title?></h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-6 form-group">
                            <label>Absence Type <span class="text-red">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check text-blue"></i></span>
                                <select name="absence" id="absence" class="form-control select2" required>
                                    <option value="">- Choose Absence Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Attachment</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-file-text text-blue"></i></span>
                                <input type="file" name="file" id="file" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Date/s <span class="text-red">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check text-blue"></i></span>
                                <input type="text" readonly="readonly" name="dates" id="dates" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>Remarks <span class="text-red">*</span></label>
                            <textarea name="reason" id="reason" class="form-control" maxlength="200" style="resize:none;" rows="4" placeholder="..." required=""></textarea>
                            <h6 id="count_message" class="text-red italic">5000 character/s remaining</h6>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="collapse" id="id" name="id" />
                    <div class="info-modal callout callout-warning text-center">Harap isi semua yang bertanda *</div>
                    <button type="submit" name="btype" id="btn-submit" class="btn btn-primary" value="submit"><i class="fa fa-check"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>	
<div id="modal-leave" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="form-default" accept-charset="UTF-8">
                <div class="modal-header">
                    <button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">×</button>
                    <h4 class="modal-title strong"><?=$page_title?></h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12 form-group">
                            <label>Leave Date/s <span class="text-red">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check text-blue"></i></span>
                                <input type="text" readonly="readonly" name="dates" id="dates" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>Remarks <span class="text-red">*</span></label>
                            <textarea name="reason" id="reason" class="form-control" maxlength="200" style="resize:none;" rows="4" placeholder="..." required=""></textarea>
                            <h6 id="count_message" class="text-red italic">200 character/s remaining</h6>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>Address while on leave <span class="text-red">*</span></label>
                            <textarea name="address" id="address" class="form-control" maxlength="200" style="resize:none;" rows="4" placeholder="..." required=""></textarea>
                            <h6 id="count_address" class="text-red italic">200 character/s remaining</h6>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>Reachable mobile phone number/s while on leave <span class="text-red">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone text-blue"></i></div>
                                <input type="text" name="leave_hp" id="leave_hp" class="form-control" required="required" placeholder="Phone 1 / Phone 2 / etc" maxlength="50">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="collapse" id="id" name="id" />
                    <div class="info-modal callout callout-warning text-center">Harap isi semua yang bertanda *</div>
                    <button type="submit" name="btype" id="btn-submit" class="btn btn-primary" value="submit"><i class="fa fa-check"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>	
</section>
</div>