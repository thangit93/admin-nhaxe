<?php 
					/**
					 * @Project BNC v2 -> Adminuser
					 * @File /data/www/superweb/ad/tmp/tpl/login.php 
					 * @Author Quang Chau Tran (quangchauvn@gmail.com) 
					 */
					if(!defined('BNC_CODE')) {
					    exit('Access Denied');
					}
					?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập quản trị web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="wrapper">
        <div class="">
            <header id="header">
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a class="logo" href="#">
                            <img class="img-responsive" src="<?=$_B['home_theme']?>/anvui/imgs/logo.png">
                        </a>
                    </div>
                    
                </div>
            </header>
            
            <div class="content login">
                <div class="container">
                    <div class="row">
                        <div class="login-box col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="login-inner">
                                <div class="login-box-title"> 
                                    <?php if(isset($return['error'])) { ?>
                                    <div class="alert alert-danger" style="margin-top: 5px;" role="alert"> 
                                        <?=$return['error']?>
                                    </div>
                                    <?php } ?>
                                    <h1><span>Đăng nhập</span></h1>
                                </div>
                                <div class="login-box-body">
                                    <form class="form-horizontal" action="" method="POST">
                                        <ul>
                                            <li>
                                                <input type="text" name="email" placeholder="Tài khoản">
                                            </li>
                                            <li>
                                                <input class="password" type="password" name="password" placeholder="Mật khẩu">
                                            </li>
                                        </ul>
                                        <button type="submit">Đăng nhập</button>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <footer class="">
                <div class="container">
                    <div class="menubotton col-lg-5 col-sm-5 col-xs-12">
                        <ul>
                            <li>
                                <a href="">Điều khoản dịch vụ</a>
                            </li>
                            <li>
                                <a href="">Chính sách riêng tư</a>
                            </li>
                        </ul>
                    </div>
                    <div class="coppyright col-lg-2 col-sm-2 col-xs-12">
                        <span>© Anvui 2017</span>
                    </div>
                    <div class="version col-lg-5 col-sm-5 col-xs-12">
                        <span>v0.16.9</span>
                    </div>
                </div>
                
            </footer>
        </div>
        <!--#header-->
    </div>
    </div>
    <!--CSS-->
    <link href="<?=$_B['home_theme']?>/anvui/plugins/owl-carousel/carousel.css" rel="stylesheet" type="text/css">
    <!-- <link href="css/layouts.css" rel="stylesheet" type="text/css"> -->
    <link href="<?=$_B['home_theme']?>/anvui/css/common.css" rel="stylesheet" type="text/css">
    <link href="<?=$_B['home_theme']?>/anvui/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?=$_B['home_theme']?>/anvui/css/mobile.css" rel="stylesheet" type="text/css">
    <!--JS-->
    <script src="<?=$_B['home_theme']?>/anvui/libs/jquery/1.12.3/jquery-1.12.3.min.js" type="text/javascript"></script>
    <script src="<?=$_B['home_theme']?>/anvui/libs/bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=$_B['home_theme']?>/anvui/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
    <script src="<?=$_B['home_theme']?>/anvui/js/functions.js" type="text/javascript"></script>
</body>

</html>
