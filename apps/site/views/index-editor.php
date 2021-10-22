<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: News Team
* @Module       : Dashboard
* @Type         : View - Index Editor
* @Date Create	: 29 Maret 2021
*
***/
$nextdate = "-";
$prevdate = "-";
if ( isset($data_nextdate) and $data_nextdate ):
    $nextdate = explode("-", $data_nextdate);
endif;
if ( isset($data_prevdate) and $data_prevdate ):
    $prevdate = explode("-", $data_prevdate);
endif;
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title mt-5"><?=$page_title?></h3>
                
                <h3 class="box-title mt-5 pull-right">
                    <a href="<?=base_url()."?m=".$prevdate[0]."&y=".$prevdate[1]?>" class="btn btn-default"><i class="fa fa-angle-double-left"></i></a>
                    <?=((isset($data_displaydate) and $data_displaydate) ? $data_displaydate : date("F Y"))?>
                    <a href="<?=base_url()."?m=".$nextdate[0]."&y=".$nextdate [1]?>" class="btn btn-default"><i class="fa fa-angle-double-right"></i></a>
                </h3>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="margin-top:13px;">Report Total Article</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive" style="height:300px;overflow-y:scroll;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Total Article</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ( isset($data_totalarticle) and $data_totalarticle):
                                    foreach($data_totalarticle as $t):
                                ?>
                                    <tr>
                                        <td><?=$t->date_time?></td>
                                        <td><?=$t->total_article?></td>
                                    </tr>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="margin-top:13px;">Alexa Rank</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive" style="height:300px;overflow-y:scroll;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Global</th>
                                        <th>Country</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ( isset($data_rankalexa) and $data_rankalexa):
                                    foreach($data_rankalexa as $t):
                                ?>
                                    <tr>
                                        <td><?=$t->alexa_date?></td>
                                        <td><?=number_format($t->rank_global, 0, ",", ".")?></td>
                                        <td><?=number_format($t->rank_country, 0, ",", ".")?></td>
                                    </tr>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="margin-top:13px;">Google Analytics Pageview</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive" style="height:300px;overflow-y:scroll;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Pageview</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ( isset($data_gapageview) and $data_gapageview):
                                    foreach($data_gapageview as $t):
                                ?>
                                    <tr>
                                        <td><?=$t->ap_date?></td>
                                        <td><?=number_format($t->total_pageview, 0, ",", ".")?></td>
                                    </tr>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>