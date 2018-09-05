<!DOCTYPE html>
<html>
    <head>

        <!-- Title -->
        <title>Eyewear - Error</title>

        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="<?= base_url('public/') ?>plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="<?= base_url('public/') ?>plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="<?= base_url('public/') ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="<?= base_url('public/') ?>plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="<?= base_url('public/') ?>plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="<?= base_url('public/') ?>plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	

        <!-- Theme Styles -->
        <link href="<?= base_url('public/') ?>css/admin/modern.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>css/admin/themes/white.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>css/admin/custom.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>css/sed_common.css" rel="stylesheet" type="text/css"/>

        <script src="<?= base_url('public/') ?>plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="<?= base_url('public/') ?>plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="page-error">
        <main class="page-content">
            <div class="page-inner">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-4 center">
                            <img src="<?= base_url('public/images/logo.jpg') ?>" id='error-page-logo'/>
                            <!--<h1 class="text-xxl text-primary text-center">Error</h1>-->
                            <div class="details">
                                <h3>Oops ! Something went wrong</h3>
                                <?php
                                if (isset($error_code) && $error_code != null) {
                                    echo '<p>' . $this->config->item($error_code, 'msg') . ' (' . $error_code . ')</p>';
                                    if (isset($error_url) && $error_url != null) {
                                        echo '<input type="button" onclick="window.location.href=\'' . $error_url[0] . '\'" value="' . $error_url[1] . '"/>';
                                    } else {
                                        echo '<input type="button" onclick="window.location.href= \''. base_url().'\' ;" value="Go Back"/>';
                                    }
                                }
                                ?>
                                <!--<p>We can't find the page you're looking for. Return <a href="index.html">Home</a> or search.</p>-->
                            </div>
                            <!--                            <form class="input-group">
                                                            <input type="text" class="form-control" placeholder="Search">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                                            </span>
                                                        </form>-->
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->

        <!-- Javascripts -->
        <script src="<?= base_url('public/') ?>plugins/jquery/jquery-2.1.3.min.js"></script>
        <script src="<?= base_url('public/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?= base_url('public/') ?>plugins/pace-master/pace.min.js"></script>
        <script src="<?= base_url('public/') ?>plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="<?= base_url('public/') ?>plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= base_url('public/') ?>plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?= base_url('public/') ?>plugins/switchery/switchery.min.js"></script>
        <script src="<?= base_url('public/') ?>plugins/uniform/jquery.uniform.min.js"></script>
        <script src="<?= base_url('public/') ?>plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="<?= base_url('public/') ?>plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="<?= base_url('public/') ?>plugins/waves/waves.min.js"></script>
        <script src="<?= base_url('public/') ?>plugins/3d-bold-navigation/js/main.js"></script>
        <script src="<?= base_url('public/') ?>js/admin/modern.js"></script>
        <script src="<?= base_url('public/') ?>js/sed_common.js"></script>

    </body>
</html>