<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: M. Maha Andar Pasaribu
* @Module       : Logger - Backup Database
* @Type         : View - Index
* @Date Create	: 22 November 2020
*
***/
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title mt-5"><?=$page_title?></h3>
            </div>
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-md-4 form-group">
                        <a href="<?=base_url("{$page_curr}/process")?>" class="btn btn-primary"><i class="fa fa-check"></i> Backup Database</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>