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
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon" sizes="57x57" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon" sizes="72x72" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon" sizes="114x114" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon" sizes="144x144" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="57x57" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="72x72" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="114x114" />
        <link href="<?=base_url("assets/login/images/stuff/logo-login.png?v=2.1")?>" rel="apple-touch-icon-precomposed" sizes="144x144" />
        <link rel="stylesheet" href="<?=base_url("assets/plugins/bootstrap/css/bootstrap.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/plugins/font-awesome/css/font-awesome.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/adminlte/css/AdminLTE.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/adminlte/css/skins/skin-blue.min.css")?>">
        <link rel="stylesheet" href="<?=base_url("assets/plugins/sweetalert2/sweetalert2.min.css")?>">


        <!--===============================================================================================-->
            <link rel="icon" type="image/png" href="<?=base_url('assets/login/images/stuff/logo-login.png') ?>"/>
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/vendor/bootstrap/css/bootstrap.min.css') ?>">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') ?>">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/vendor/animate/animate.css') ?>">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/vendor/css-hamburgers/hamburgers.min.css') ?>">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/vendor/animsition/css/animsition.min.css') ?>">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/vendor/select2/select2.min.css') ?>">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/vendor/daterangepicker/daterangepicker.css') ?>">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/css/util.css') ?>">
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/login/css/main.css') ?>">
        <!--===============================================================================================-->
            <!-- <link rel="shortcut icon" href="<?=base_url('assets/login/images/stuff/logo-login.png')?>"> -->
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/swiper/css/swiper-bundle.css')?>">
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/swiper/css/swiper-bundle.min.css')?>">
        <style>
            .swiper {
            width: 100%;
            height: 100%;
            }
        </style>
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
    <body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                <form class="login100-form validate-form p-5" id="form-login" action="<?=base_url("auth/signin.do")?>" method="post" style="margin-top:17ex !important; margin-bottom:17ex !important">
                    <span class="login100-form-title p-b-34">
                        <a href="#"><img src="<?php echo base_url('assets/login/images/stuff/logo-login.png') ?>" width="50%"></a>
                    </span>
                    <span class="login100-form-title p-b-34">
						Sign In To Admin
					</span>

					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
                        <input id="first-name" class="input100" type="text" name="username" placeholder="User name" autocomplete="off">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
                        <input class="input100" type="password" name="passwd" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button id="kt_login_signin_submit"  class="login100-form-btn">
							Sign in
                        </button>
					</div>

					
				</form>

				<!-- <div class="login100-more" style="background-image: url(<?php echo base_url("assets/login/images/bg-01.jpg")?>)"></div> -->
                <div class="login100-more">
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                        <!-- Slides -->
                                <div class="swiper-slide" style="background-image: url(<?php echo base_url("assets/login/images/image-login1.jpg")?>);background-repeat: no-repeat; background-size:cover"></div>
                                <div class="swiper-slide" style="background-image: url(<?php echo base_url("assets/login/images/image-login2.jpg")?>);background-repeat: no-repeat; background-size:cover"></div>
                                <div class="swiper-slide" style="background-image: url(<?php echo base_url("assets/login/images/image-login3.jpg")?>);background-repeat: no-repeat; background-size:cover"></div>
                                <div class="swiper-slide" style="background-image: url(<?php echo base_url("assets/login/images/image-login5.jpg")?>);background-repeat: no-repeat; background-size:cover"></div>
                                <div class="swiper-slide" style="background-image: url(<?php echo base_url("assets/login/images/image-login6.jpg")?>);background-repeat: no-repeat; background-size:cover"></div>
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

			</div>
		</div>
	</div>

    <div id="dropDownSelect1"></div>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->

    
    <!--===============================================================================================-->
        <script src="<?=base_url('assets/login/vendor/jquery/jquery-3.2.1.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/swiper/js/swiper-bundle.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/swiper/js/swiper-bundle.min.js')?>"></script>
    <!--===============================================================================================-->
        <script src="<?=base_url('assets/login/vendor/animsition/js/animsition.min.js') ?>"></script>
    <!--===============================================================================================-->
        <script src="<?=base_url('assets/login/vendor/bootstrap/js/popper.js') ?>"></script>
        <script src="<?=base_url('assets/login/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
    <!--===============================================================================================-->
        <script src="<?=base_url('assets/login/vendor/select2/select2.min.js') ?>"></script>
        <script>
            $(".selection-2").select2({
                minimumResultsForSearch: 20,
                dropdownParent: $('#dropDownSelect1')
            });

            var swiper = new Swiper('.swiper', {
                spaceBetween: 100,
                centeredSlides: true,
                effect: "fade",
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        </script>
    <!--===============================================================================================-->
        <script src="<?=base_url('assets/login/vendor/daterangepicker/moment.min.js') ?>"></script>
        <script src="<?=base_url('assets/login/vendor/daterangepicker/daterangepicker.js') ?>"></script>
    <!--===============================================================================================-->
        <script src="<?=base_url('assets/login/vendor/countdowntime/countdowntime.js') ?>"></script>
    <!--===============================================================================================-->
        <script src="<?=base_url('assets/login/js/main.js') ?>"></script>

        <!-- <script src="<?=base_url("assets/plugins/jQuery/jquery-2.2.3.min.js")?>"></script> -->
        <script src="<?=base_url("assets/plugins/bootstrap/js/bootstrap.min.js")?>"></script>
        <script src="<?=base_url("assets/plugins/jquery-form/jquery.form.min.js")?>"></script>
        <script src="<?=base_url("assets/plugins/sweetalert2/sweetalert2.min.js")?>"></script>
        <script src="<?=base_url("assets/js/auth/login.js?v=1.00.003")?>"></script>
    </body>
</html>
