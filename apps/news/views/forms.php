<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Maha Andar
* @Module       : Maps Restaurant - Forms
* @Type         : View
* @Date Create	: 17 May 2021
*
***/
$id_news    = "";
$title      = "";
$desc       = "";
$image_news = "";
$expired_at = "";

if ( isset($data) and $data ):
    $id_news    = $data[0]->id_news;
    $title      = $data[0]->title_news;
    $desc       = $data[0]->description_news;
    $image_news = $data[0]->image_news;
    $expired_at = $data[0]->expired_at;

endif;
$facility_arr = [
    "1" => "Wifi",
    "2" => "Toilet",
    "3" => "Tempat Parkir",
    "4" => "Musholla"
];
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title mt-5"><?=$page_title?></h3>
                <a href="<?=base_url("{$page_curr}")?>" class="btn btn-sm btn-danger pull-right"><i class="fa fa-arrow-left"></i></a>
            </div>
            <div class="box-body">
            <form action="<?=base_url("{$page_curr}/forms/save")?>" class="form-horizontal" method="POST" id="form-default" accept-charset="UTF-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">News Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="title">Judul <span class="text-red">*</span></label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" class="form-control" name="title" id="title" maxlength="75" placeholder="Judul Berita" required value="<?=$title?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="desc">Deskripsi <span class="text-red">*</span></label>
                                <div class="col-sm-9 col-md-10">
                                    <textarea name="desc" id="desc" class="form-control" rows="6" style="resize:none;" placeholder="Deskripsi Singkat" required><?= $desc ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="desc">Expired Date</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" name="expired_at" class="form-control" value="<?= !empty($expired_at) ? date('d F Y', strtotime($expired_at)) : '' ?>" readonly style="background: white;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="file">Image</label>
                                <div class="col-sm-9 col-md-10">
                                    <!-- <input type="file" class="form-control" name="file" id="file" /> -->
                                    <div class="row">
                                        <div class="col-md-2">
                                            <?php if(!empty($image_news)) { ?>
                                                <img id="preview_gambar" class="img-view form-control" src="<?php echo base_url('./../assets_tbs/news/').$image_news ?>" style="width: 40ex;height:40ex">
                                            <?php } else { ?>
                                                <img id="preview_gambar" class="img-view form-control" style="width: 40ex;height:40ex">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="file" name="file" value="<?=$image_news?>" id="file" class="form-control" onchange="readURL(this);" style="width: 40ex;"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="hidden" name="id" id="id" value="<?=$id_news?>" />
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>
</div>
<script src="<?=base_url("assets/plugins/jQuery/jquery-2.2.3.min.js")?>"></script>

<script>
<?php
$render_iso = '<option value="">Pilih ISO</option>';
if ( isset($data_iso) and $data_iso ):
    foreach($data_iso as $t):
        $render_iso .= '<option value="'.$t->iso_id.'">'.$t->iso_name.'</option>';
    endforeach;
endif;
?>
var data_iso = '<?=$render_iso?>';

$(document).ready(function() {

    $('input[name=expired_at]').datepicker({
        format: 'dd MM yyyy',
        todayHighlight: true
    });

    // $('input[name=end_date]').datepicker({
    //     format: 'dd MM yyyy',
    //     todayHighlight: true
    // });
});
</script>