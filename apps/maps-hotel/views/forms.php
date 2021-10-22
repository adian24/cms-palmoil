<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Maha Andar
* @Module       : Maps Hotel - Forms
* @Type         : View
* @Date Create	: 17 May 2021
*
***/
$map_id     = "";
$title      = "";
$desc       = "";
$address    = "";
$duration   = "";
$website    = "";
$phone1     = "";
$phone2     = "";
$latitude   = "";
$longitude  = "";
$photo      = "";
if ( isset($data) and $data ):
    $map_id     = $data[0]->map_id;
    $title      = $data[0]->name;
    $desc       = $data[0]->body;
    $address    = $data[0]->location;
    $duration   = $data[0]->duration;
    $website    = $data[0]->website;
    $phone1     = $data[0]->phone1;
    $phone2     = $data[0]->phone2;
    $latitude   = $data[0]->latitude;
    $longitude  = $data[0]->longitude;
    $photo      = $data[0]->photo;
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
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Informasi</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">Sertifikasi</a></li>
                        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Fasilitas</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="title">Nama <span class="text-red">*</span></label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" class="form-control" name="title" id="title" maxlength="75" placeholder="Nama Hotel" required value="<?=$title?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="desc">Deskripsi <span class="text-red">*</span></label>
                                <div class="col-sm-9 col-md-10">
                                    <textarea name="desc" id="desc" class="form-control" rows="3" style="resize:none;" maxlength="200" placeholder="Deskripsi Singkat" required><?=$desc?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="address">Alamat <span class="text-red">*</span></label>
                                <div class="col-sm-9 col-md-10">
                                    <textarea name="address" id="address" class="form-control" rows="3" style="resize:none;" maxlength="200" placeholder="Alamat" required><?=$address?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="duration">Jam Operasional</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" class="form-control" name="duration" id="duration" maxlength="20" placeholder="Jam Operasional" value="<?=$duration?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="website">Website</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" class="form-control" name="website" id="website" maxlength="100" placeholder="Website" value="<?=$website?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="phone1">Telepon 1</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" class="form-control" name="phone1" id="phone1" maxlength="20" placeholder="Telepon 1" value="<?=$phone1?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="phone2">Telepon 2</label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" class="form-control" name="phone2" id="phone2" maxlength="20" placeholder="Telepon 2" value="<?=$phone2?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="latitude">Latitude <span class="text-red">*</span></label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" class="form-control" name="latitude" id="latitude" maxlength="100" placeholder="Latitude" required value="<?=$latitude?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="longitude">Longitude <span class="text-red">*</span></label>
                                <div class="col-sm-9 col-md-10">
                                    <input type="text" class="form-control" name="longitude" id="longitude" maxlength="100" placeholder="Longitude" required value="<?=$longitude?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-md-2" for="file">Photo</label>
                                <div class="col-sm-9 col-md-10">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <?php if(!empty($photo)) { ?>
                                                <img id="preview_gambar" class="img-view form-control" src="<?php echo base_url('./../assets/hotel/').$photo ?>" style="width: 40ex;height:40ex">
                                            <?php } else { ?>
                                                <img id="preview_gambar" class="img-view form-control" style="width: 40ex;height:40ex">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="file" name="file" value="<?=$photo?>" id="file" class="form-control" onchange="readURL(this);" style="width: 40ex;"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <button type="button" id="btn-add-sert" class="btn btn-primary pull-right"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="tab-cert" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Sertifikat</th>
                                            <th>Masa Berlaku</th>
                                            <th>Jenis ISO</th>
                                            <th>Dokumen Terlampir</th>
                                            <th><i class="fa fa-cog"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ( isset($data_certificate) and $data_certificate):
                                        foreach($data_certificate as $tt):
                                    ?>
                                        <tr>
                                            <td><input type="text" name="cert_name[]" value="<?=$tt->cert_name?>" placeholder="Nama Sertifikat" class="form-control" maxlength="100" /></td>
                                            <td><input type="text" name="cert_year[]" value="<?=$tt->cert_exp?>" placeholder="Masa Berlaku" class="form-control" maxlength="100" /></td>
                                            <td>
                                            <select name="cert_iso[]" class="form-control">
                                                <option value="">Pilih ISO</option>
                                            <?php
                                            if ( isset($data_iso) and $data_iso ):
                                                foreach($data_iso as $tis):
                                                    if ( $tt->iso_id == $tis->iso_id )
                                                        echo '<option value="'.$tis->iso_id.'" selected="selected">'.$tis->iso_name.'</option>';
                                                    else
                                                        echo '<option value="'.$tis->iso_id.'">'.$tis->iso_name.'</option>';
                                                endforeach;
                                            endif;
                                            ?>
                                            </select>
                                            </td>
                                            <td><input type="file" name="cert_file[]" class="form-control" /></td>
                                            <td><input type="hidden" name="cert_oldfile[]" value="<?=$tt->cert_file?>" /><button type="button" class="btn btn-sm btn-danger btn-rem-cert"><i class="fa fa-close"></i></button></td>
                                        </tr>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <div class="row clearfix">
                                <?php
                                foreach($facility_arr as $key=>$val):
                                    $checked = false;
                                    if ( isset($data_facility) and $data_facility ):
                                        foreach($data_facility as $t):
                                            if ( $t->facility_num == $key ) $checked = true;
                                        endforeach;
                                    endif;
                                    $val_checked = ($checked) ? " checked" : "";
                                ?>
                                <div class="col-md-2 col-sm-4 col-xs-6 form-group">
                                    <div class="checkbox"><label><input type="checkbox"<?=$val_checked?> name="facility[]" value="<?=$key?>"> <?=$val?></label></div>
                                </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="hidden" name="id" id="id" value="<?=$map_id?>" />
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>
</div>
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
</script>