<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: M. Maha Andar Pasaribu
* @Module       : Site
* @Type         : Auth/Login
* @Date Create	: 03 September 2018
* @Date Revise	: 20 December 2018
* @Version		: 1.0.1
* @Notes		:	+ Initial Commit
                    (Version 1.0.1) - 20 December 2018
                    + Adding Site JS
                    + Adding Language into module information
*
***/
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?=(isset($page_title) ? $page_title: ''). ' | ' .$site['title']?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <meta name="author" content="<?=$site['title']?>">
        <meta name="description" content="">
        <link href="<?=base_url("assets/images/favicon.ico?v=2.1")?>" rel="icon" type="image/x-icon">
        <link href="<?=base_url("assets/images/LabelMapsLogo.png?v=2.1")?>" rel="apple-touch-icon" sizes="57x57" />
        <link href="<?=base_url("assets/images/LabelMapsLogo.png?v=2.1")?>" rel="apple-touch-icon" sizes="72x72" />
        <link href="<?=base_url("assets/images/LabelMapsLogo.png?v=2.1")?>" rel="apple-touch-icon" sizes="114x114" />
        <link href="<?=base_url("assets/images/LabelMapsLogo.png?v=2.1")?>" rel="apple-touch-icon" sizes="144x144" />
        <link href="<?=base_url("assets/images/LabelMapsLogo.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="57x57" />
        <link href="<?=base_url("assets/images/LabelMapsLogo.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="72x72" />
        <link href="<?=base_url("assets/images/LabelMapsLogo.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="114x114" />
        <link href="<?=base_url("assets/images/LabelMapsLogo.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="144x144" />
        <link rel="stylesheet" href="<?=base_url("assets/plugins/bootstrap/css/bootstrap.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/plugins/font-awesome/css/font-awesome.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/adminlte/css/AdminLTE.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/adminlte/css/skins/skin-blue.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/plugins/sweetalert2/sweetalert2.min.css")?>">
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="<?=base_url("assets/css/style.css")?>">
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
    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- <div class="login-logo">
               
            </div> -->
            <div class="login-box-body" style="border-radius:10px">
                <img src="<?=base_url("assets/images/LabelMapsLogo.png?v=2")?>" style="width: 46ex;" alt="Inventory" >
                <p class="login-box-msg">Masuk untuk memulai sesi anda</p>
                <form id="form-login" action="<?=base_url("auth/signin.do")?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" name="username" id="username" required class="form-control" placeholder="Nama Pengguna" maxlength="30">
                        <span class="fa fa-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="passwd" required class="form-control" placeholder="Kata Sandi" maxlength="30">
                        <span class="fa fa-key form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="<?=base_url("assets/plugins/jQuery/jquery-2.2.3.min.js")?>"></script>
        <script src="<?=base_url("assets/plugins/bootstrap/js/bootstrap.min.js")?>"></script>
        <script src="<?=base_url("assets/plugins/jquery-form/jquery.form.min.js")?>"></script>
        <script src="<?=base_url("assets/plugins/sweetalert2/sweetalert2.min.js")?>"></script>
        <script src="<?=base_url("assets/js/auth/login.js?v=1.00.003")?>"></script>
    </body>
</html>
