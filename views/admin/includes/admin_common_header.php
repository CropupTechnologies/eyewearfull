<!DOCTYPE html>
<html>
    <head>

        <!-- Title -->
        <title><?= $title;?></title>

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
        <link href="<?= base_url('public/') ?>plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>	
        <link href="<?= base_url('public/') ?>plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet" type="text/css"/>	
        <link href="<?= base_url('public/') ?>plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>	
        <link href="<?= base_url('public/') ?>plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>	
        <link href="<?= base_url('public/') ?>plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>plugins/parsley/parsley.css" rel="stylesheet" type="text/css"/>

        <!-- Theme Styles -->
        <link href="<?= base_url('public/') ?>css/admin/modern.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>css/sed_common.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>css/admin/themes/white.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('public/') ?>css/admin/custom.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url('public/') ?>plugins/jquery/jquery-2.1.3.min.js"></script>
        <script src="<?= base_url('public/') ?>plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="<?= base_url('public/') ?>plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        <script src="<?= base_url('public/') ?>plugins/dropzone/dropzone.min.js"></script>
        <script src="<?= base_url('public/') ?>plugins/parsley/parsley.min.js"></script>
        <script src="<?= base_url('public/') ?>plugins/jquery-counterup/jquery.counterup.min.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="page-header-fixed">
        <div class="overlay"></div>
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s1">
            <h3><span class="pull-left">Chat</span><a href="javascript:void(0);" class="pull-right" id="closeRight"><i class="fa fa-times"></i></a></h3>
            <div class="slimscroll">
<!--                <a href="javascript:void(0);" class="showRight2"><img src="<?= base_url('public/') ?>images/admin_images/avatar2.png" alt=""><span>Sandra smith<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="<?= base_url('public/') ?>images/admin_images/avatar3.png" alt=""><span>Amily Lee<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="<?= base_url('public/') ?>images/admin_images/avatar4.png" alt=""><span>Christopher Palmer<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="<?= base_url('public/') ?>images/admin_images/avatar5.png" alt=""><span>Nick Doe<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="<?= base_url('public/') ?>images/admin_images/avatar2.png" alt=""><span>Sandra smith<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="<?= base_url('public/') ?>images/admin_images/avatar3.png" alt=""><span>Amily Lee<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="<?= base_url('public/') ?>images/admin_images/avatar4.png" alt=""><span>Christopher Palmer<small>Hi! How're you?</small></span></a>
                <a href="javascript:void(0);" class="showRight2"><img src="<?= base_url('public/') ?>images/admin_images/avatar5.png" alt=""><span>Nick Doe<small>Hi! How're you?</small></span></a>-->
            </div>
        </nav>
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
            <h3><span class="pull-left">Sandra Smith</span> <a href="javascript:void(0);" class="pull-right" id="closeRight2"><i class="fa fa-angle-right"></i></a></h3>
            <div class="slimscroll chat">
                <div class="chat-item chat-item-left">
                    <div class="chat-image">
                        <!--<img src="<?= base_url('public/') ?>images/admin_images/avatar2.png" alt="">-->
                    </div>
                    <div class="chat-message">
                        Hi There!
                    </div>
                </div>
                <div class="chat-item chat-item-right">
                    <div class="chat-message">
                        Hi! How are you?
                    </div>
                </div>
                <div class="chat-item chat-item-left">
                    <div class="chat-image">
                        <!--<img src="<?= base_url('public/') ?>images/admin_images/avatar2.png" alt="">-->
                    </div>
                    <div class="chat-message">
                        Fine! do you like my project?
                    </div>
                </div>
                <div class="chat-item chat-item-right">
                    <div class="chat-message">
                        Yes, It's clean and creative, good job!
                    </div>
                </div>
                <div class="chat-item chat-item-left">
                    <div class="chat-image">
                        <!--<img src="<?= base_url('public/') ?>images/admin_images/avatar2.png" alt="">-->
                    </div>
                    <div class="chat-message">
                        Thanks, I tried!
                    </div>
                </div>
                <div class="chat-item chat-item-right">
                    <div class="chat-message">
                        Good luck with your sales!
                    </div>
                </div>
            </div>
            <div class="chat-write">
                <form class="form-horizontal" action="javascript:void(0);">
                    <input type="text" class="form-control" placeholder="Say something">
                </form>
            </div>
        </nav>
        <div class="menu-wrap">
            <nav class="profile-menu">
                <div class="profile"><img src="<?= base_url('public/') ?>images/admin_images/avatar1.png" width="52" alt="David Green"/><span>David Green</span></div>
                <div class="profile-menu-list">
                    <a href="#"><i class="fa fa-star"></i><span>Favorites</span></a>
                    <a href="#"><i class="fa fa-bell"></i><span>Alerts</span></a>
                    <a href="#"><i class="fa fa-envelope"></i><span>Messages</span></a>
                    <a href="#"><i class="fa fa-comment"></i><span>Comments</span></a>
                </div>
            </nav>
            <button class="close-button" id="close-button">Close Menu</button>
        </div>
        <form class="search-form" action="#" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
                </span>
            </div><!-- Input Group -->
        </form><!-- Search Form -->
        <main class="page-content content-wrap">
