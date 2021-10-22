<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: M. Maha Andar Pasaribu
* @Module       : layout-bot
* @Type         : View
* @Date Create	: 01 September 2018
* @Date Revise	: 20 December 2018
* @Version		: 1.0.12
* @Notes		:	+ Initial Commit
                    (Version 1.0.1) - 17 November 2018
                    + Remove the positioning of default.js to be at top of add on js
                    (Version 1.0.11) - 19 December 2018
                    + Remove 'M' in copyright and replace with site - title
                    (Version 1.0.12) - 20 December 2018
                    + Adding Site Language
*
***/
?>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> <?=$site['version']?>
            </div>
            <strong>Copyright &copy; <?=$site['year']?> <a href="javascript:;"><?=$site['title']?></a>.</strong> All rights
        reserved. Page rendered in {elapsed_time}
        </footer>
    </div>
    <div id="pass-modal" class="modal" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?=base_url("auth/change-password")?>" method="POST" id="pass-form" accept-charset="UTF-8">
                    <div class="modal-header">
                        <button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">×</button>
                        <h4 class="modal-title strong">Ganti Kata Sandi</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-xs-12 form-group">
                                <label>Old Password <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="opwd" maxlength="50" name="opwd" value="" placeholder="..." required="">
                                    <span class="input-group-addon"><i class="text-blue click-to-view fa fa-eye"></i></span>
                                </div>
                            </div>
                            <div class="col-xs-12 form-group">
                                <label>New Password <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="npwd" maxlength="50" name="npwd" value="" placeholder="..." required="">
                                    <span class="input-group-addon"><i class="fa fa-eye text-blue click-to-view"></i></span>
                                </div>
                            </div>
                            <div class="col-xs-12 form-group">
                                <label>Confirm Password <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="cpwd" maxlength="50" name="cpwd" value="" placeholder="..." required="">
                                    <span class="input-group-addon"><i class="fa fa-eye text-blue click-to-view"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-pass" class="btn btn-primary"><i class="fa fa-check mr-5"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>var base = "<?=base_url()?>";</script>
    <script src="<?=base_url("assets/plugins/jQuery/jquery-2.2.3.min.js")?>"></script>
    <script src="<?=base_url("assets/plugins/bootstrap/js/bootstrap.min.js")?>"></script>
    <script src="<?=base_url("assets/plugins/jquery-form/jquery.form.min.js")?>"></script>
    <script src="<?=base_url("assets/plugins/select2/select2.full.min.js")?>"></script>
    <script src="<?=base_url("assets/plugins/sweetalert2/sweetalert2.min.js")?>"></script>
    <script src="<?=base_url("assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js")?>"></script>
    <script src="<?=base_url("assets/adminlte/js/adminlte.min.js")?>"></script>
    <script src="<?=base_url("assets/js/default".(ENVIRONMENT=="development"?"":".min").".js?v=1.0.13")?>"></script>
    <?php
        if ( isset($site['js']) ){
            foreach($site['js'] as $js){
                $exp = explode(",", $js);
                echo "<script src=\"{$exp[0]}".($exp[1]=="development"?"":".min").".js?v={$exp[2]}\"></script>";;
            }
        }
    ?>
    </body>
</html>