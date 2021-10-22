<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: M. Maha Andar Pasaribu
* @Module       : layout-top
* @Type         : View
* @Date Create	: 01 September 2018
* @Date Revise	: 19 December 2018
* @Version		: 1.0.1
* @Notes		:	+ Initial Commit
                    (Version 1.0.1) - 19 December 2018
                    + Update Image based on full url SESSSION Config
                    + Set Skin Red For Admin Sekolah KuPikat
*
***/
?>
<!Doctype html>
<html lang="en">
    <head>
        <title><?=(isset($page_title) ? strip_tags($page_title): ''). ' | ' .$site['title']?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <meta name="author" content="ERP">
        <meta name="description" content="">
        <link href="<?=base_url("assets/images/favicon.ico?v=2.1")?>" rel="icon" type="image/x-icon">
        <link href="<?=base_url("assets/images/logo-57.png?v=2.1")?>" rel="apple-touch-icon" sizes="57x57" />
        <link href="<?=base_url("assets/images/logo-72.png?v=2.1")?>" rel="apple-touch-icon" sizes="72x72" />
        <link href="<?=base_url("assets/images/logo-114.png?v=2.1")?>" rel="apple-touch-icon" sizes="114x114" />
        <link href="<?=base_url("assets/images/logo-144.png?v=2.1")?>" rel="apple-touch-icon" sizes="144x144" />
        <link href="<?=base_url("assets/images/logo-57.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="57x57" />
        <link href="<?=base_url("assets/images/logo-72.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="72x72" />
        <link href="<?=base_url("assets/images/logo-114.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="114x114" />
        <link href="<?=base_url("assets/images/logo-144.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="144x144" />
        <link rel="stylesheet" href="<?=base_url("assets/plugins/bootstrap/css/bootstrap.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/plugins/select2/select2.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/plugins/font-awesome/css/font-awesome.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/adminlte/css/AdminLTE.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/adminlte/css/skins/skin-green.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/plugins/sweetalert2/sweetalert2.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css")?>">
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="<?=base_url("assets/css/style".(ENVIRONMENT == "development" ? "" : ".min").".css?v=1.0.4")?>">
        <?php
        if ( isset($site['css']) ){
            foreach($site['css'] as $css){
                $exp = explode(",", $css);
                echo "<link type=\"{$exp[0]}\" rel=\"{$exp[1]}\" href=\"{$exp[2]}\" />"."\r\n";
            }
        }
        ?>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-green sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="<?=base_url()?>" class="logo">
                    <span class="logo-mini"><?=$site['shortcut']?></span>
                    <span class="logo-lg"><?=$site['title']?></span>
                </a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?=$this->user->getPhoto()?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?=$this->user->getName()?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?=$this->user->getPhoto()?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?=$this->user->getName()?>
                                            <small><?=(isset($site['data_role'][$this->user->getRole()]) ? $site['data_role'][$this->user->getRole()] : "Developer")?></small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="javascript:;" class="btn btn-warning btn-flat change-pass hidden-xs">Ganti Kata Sandi</a>
                                            <a href="javascript:;" class="btn btn-warning btn-default btn-flat change-pass visible-xs">Ganti Kata Sandi</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?=base_url("auth/signout")?>" class="btn btn-danger btn-flat hidden-xs">Keluar</a>
                                            <a href="<?=base_url("auth/signout")?>" class="btn btn-danger btn-default btn-flat visible-xs">Keluar</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <?php
                $master = "";$sub = "";
                if ( isset($page_nav) ){
                    $exp = explode("::", $page_nav);
                    if ( count($exp) > 1 ){
                        $master = $exp[0];
                        $sub = $exp[1];
                    }
                    else $master = $page_nav;
                }
            ?>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header text-lime" style="font-size:14px;"><i class="fa fa-shield"></i> Navigasi Utama</li>
                        <?php
                        $currnav  = isset($currnav) ? $currnav : "";
                        $access   = ($this->user->getAccess()) ? explode(",", $this->user->getAccess()) : [];
                        if ( isset($site['side_menu']) and $site['side_menu'] ):
                            foreach($site['side_menu'] as $key=>$val)
                            {
                                if ( $val['child'] )
                                {
                                    if ( in_array($key, $access) )
                                    {
                                        $isactive = $master == $key ? "active" : "";
                                        echo "<li class=\"treeview {$isactive}\">
                                        <a href=\"javascript:;\">
                                            <i class=\"{$val['icon']}\"></i> <span>{$val['title']}</span>
                                            <span class=\"pull-right-container\">
                                                <i class=\"fa fa-angle-left pull-right\"></i>
                                            </span>
                                        </a>
                                        <ul class=\"treeview-menu\">";
                                        foreach($val['child'] as $keyc=>$valc)
                                        {
                                            if ( in_array($keyc, $access))
                                            {
                                                $isactive = $sub == $keyc ? "active" : "";
                                                echo "<li class=\"{$isactive}\"><a href=\"".base_url($keyc)."\"><i class=\"fa fa-circle\"></i> {$valc}</a></li>";
                                            }
                                        }
                                        echo "</ul></li>";
                                    }
                                }
                                else
                                {
                                    if ( in_array($key, $access) )
                                    {
                                        $isactive  = $master == $key ? "active" : "";
                                        $headernav = $key == "dashboard" ? "" : $key;
                                        $headernav = base_url($headernav);
                                        echo "
                                        <li class=\"{$isactive}\">
                                            <a href=\"{$headernav}\">
                                                <i class=\"{$val['icon']}\"></i> <span>{$val['title']}</span>
                                            </a>
                                        </li>";
                                    }
                                }
                            }
                        endif;
                        ?>
                    </ul>
                </section>
            </aside>