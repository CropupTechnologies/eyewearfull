<!DOCTYPE html>
<html>
    <head>

        <!-- Title -->
        <title>Eyewear.lk  | Login - Sign in</title>

        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="<?= base_url('public') ?>/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="<?= base_url('public') ?>/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="<?= base_url('public') ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public') ?>/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public') ?>/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="<?= base_url('public') ?>/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="<?= base_url('public') ?>/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="<?= base_url('public') ?>/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public') ?>/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	

        <!-- Theme Styles -->
        <link href="<?= base_url('public') ?>/css/admin/modern.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public') ?>/css/admin/themes/white.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public') ?>/css/admin/custom.css" rel="stylesheet" type="text/css"/>

        <script src="<?= base_url('public') ?>/plugins/jquery/jquery-2.1.3.min.js"></script>
        <script src="<?= base_url('public') ?>/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="<?= base_url('public') ?>/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        <link href="<?= base_url('public/') ?>css/sed_common.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>plugins/parsley/parsley.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url('public/') ?>js/sed_common.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .login-box .logo-name{
                font-size: 25px;
                color: crimson;
            }
            .login-box {
                margin: auto;
                max-width: 400px;
                padding: 20px;
                background: white;
                box-shadow: 5px 5px 20px #c4d8f9;
                border-radius: 5px;
            }
            .logo-image-login {
                width: 100px;
                margin-left: 110px;
            }
            .round-input {
                border-radius: 5px;
            }
            .image-box-row{
                margin-bottom: 20px;
            }
            .app-name{
                font-size: 10px;
                margin-top: 0;
            }
            .design-by{
                margin-bottom: 0;
            }
            .form-group{
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body class="page-login">
        <main class="page-content">
            <div class="page-inner">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-6 center">
                            <div class="login-box">
                                <div class="col-md-12 image-box-row">
                                    <img src="<?php echo base_url(); ?>public/images/logo.jpg" class="img-responsive img-rounded logo-image-login">
                                </div>
                                <p class="text-center m-t-md">Please login into your account.</p>
                                <?php
                                if (isset($_SESSION['message'])) {
                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $_SESSION['message'] ?>
                                    </div>
                                    <?php
                                    unset($_SESSION['message']);
                                }
                                ?>
                                <form class="m-t-md" action="<?= base_url('admin/login') ?>" method="post" id="login-form">
                                    <div class="form-group ">
                                        <input type="text" class="form-control round-input" name="username" placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control round-input" name="password" placeholder="Password" required>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block round-input">Login</button>
                                    <a data-toggle="modal" data-target="#forgotPasswordModal" class="display-block text-center m-t-md text-sm hand-cursor">Forgot Password?</a>
<!--                                    <p class="text-center m-t-xs text-sm">Do not have an account?</p>
                                    <a href="register.html" class="btn btn-default btn-block m-t-md">Create an account</a>-->
                                </form>
                            </div>
                        </div>
                    </div><!-- Row -->

                    <p class="text-center m-t-xs text-sm design-by">Copyright &copy; 2018 | Solution by <a href="http://smartedesigners.com/" title="Web Design and Development Sri Lanka">Smart eDesigners.</a></p>
                    <p class="text-center m-t-xs text-sm app-name"><?= APP_NAME . ' ' . APP_VERSION ?></p>
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        <?= $common_modals ?>
        <script>
            var BASEURL = '<?= base_url() ?>';
            var messages = [];
            messages[5] = '<?= $this->config->item(5, 'msg') ?>';
            $('#login-form').submit(function (e) {
                if ($("#forgotPasswordModal").data('bs.modal') && $("#forgotPasswordModal").data('bs.modal').isShown) {
                    e.stopPropagation();
                    e.preventDefault();
                    reset_password();
                }
            });
        </script>
        <!-- Javascripts -->
        <script src="<?= base_url('public') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?= base_url('public') ?>/plugins/pace-master/pace.min.js"></script>
        <script src="<?= base_url('public') ?>/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="<?= base_url('public') ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= base_url('public') ?>/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?= base_url('public') ?>/plugins/switchery/switchery.min.js"></script>
        <script src="<?= base_url('public') ?>/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="<?= base_url('public') ?>/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="<?= base_url('public') ?>/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="<?= base_url('public') ?>/plugins/waves/waves.min.js"></script>
        <script src="<?= base_url('public') ?>/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="<?= base_url('public') ?>/js/admin/modern.js"></script>
        <script src="<?= base_url('public/') ?>plugins/parsley/parsley.min.js"></script>        

    </body>
</html>