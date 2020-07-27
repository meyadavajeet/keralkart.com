<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php
            if (!empty($page_title)) {
                echo $page_title;
            }
            ?>
        </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- adding fevicon -->
    <link rel="icon" href="<?=base_url()?>assets/fevicon/KeralKart-fevicon.png" type="image/png" sizes="16x16">
<!-- End of fevicon -->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css' ?>">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/font-awesome.min.css' ?>">-->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery.dataTables.min.css' ?>">
        <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">-->
        <!-- time picker -->
        <!--<link href="<?php //echo base_url().'assets/timepicker/jquery.timeentry.css'                                      ?>" rel="stylesheet">-->

        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/AdminLTE.min.css' ?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/_all-skins.min.css' ?>">
        <!-- Morris chart -->
        <!-- <link rel="stylesheet" href="bower_components/morris.js/morris.css"> -->
        <!-- jvectormap -->
        <!-- <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css"> -->
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap-datepicker.min.css' ?>">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/daterangepicker.css' ?>">
        <!-- bootstrap wysihtml5 - text editor -->
        <!-- <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
        <!--Data tables-->
        <!--        <link rel="stylesheet" type="text/css" href="<?php //echo base_url() . 'assets/css/jquery.dataTables.css'               ?>">-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/dataTables.bootstrap4.css' ?>">

        <!-- Google Font -->
        <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/font1css.css' ?>">
         <!-- select to  -->
        <!-- <link href="<?php echo base_url() ?>assets/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" /> -->


        <style>
            form .error {
                color: #ff0000;
            }

            .error1 {
                color: red;
            }

            /*            .alert {
                                    height: 20px;
                                }*/
        </style>
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/dataTables.bootstrap.min.css' ?>">
        <!--<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">-->
        <link rel="stylesheet" href="<?= base_url() . 'assets/css/buttons.dataTables.min.css' ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/responsive.bootstrap.min.css' ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/fixedHeader.bootstrap.min.css' ?>">
        <!--        <link rel="stylesheet" href="<?php //echo base_url() . 'assets/css/toastr.min.css'                          ?>">-->
        <!--<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">-->
        <link href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>" rel="stylesheet">
        <!-- jQuery 3 -->

        <script src="<?php echo base_url() . 'assets/js/jquery.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/validate.js' ?>"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url() . 'assets/js/jquery-ui.min.js' ?>"></script>
        <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>
        <!-- Morris.js charts -->
        <!-- <script src="bower_components/raphael/raphael.min.js"></script>
            <script src="bower_components/morris.js/morris.min.js"></script> -->
        <!-- Sparkline -->
        <script src="<?php echo base_url() . 'assets/js/jquery.sparkline.min.js' ?>"></script>
        <!-- jvectormap -->
        <!-- <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
            <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
        <!-- jQuery Knob Chart -->
        <!-- <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script> -->
        <!-- daterangepicker -->
        <script src="<?php echo base_url() . 'assets/js/moment.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/daterangepicker.js' ?>"></script>
        <!-- datepicker -->
        <script src="<?php echo base_url() . 'assets/js/bootstrap-datepicker.min.js' ?>"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <!-- <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
        <!-- Slimscroll -->
        <script src="<?php echo base_url() . 'assets/js/jquery.slimscroll.min.js' ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url() . 'assets/js/fastclick.js' ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url() . 'assets/js/adminlte.min.js' ?>"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!--<script src="<?php //echo base_url() . 'assets/js/dashboard.js'                  ?>"></script>-->
        <!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
        <script src="<?php echo base_url() . 'assets/js/sweetalert.min.js' ?>"></script>
<!-- select to-->

    <script src="<?php  echo base_url();?>assets/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <!--time picker

            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="<?php //echo base_url().'assets/timepicker/jquery.plugin.js'                                      ?>"></script>
            <script src="<?php //echo base_url().'assets/timepicker/jquery.timeentry.js'                                      ?>"></script>

            //time picker-->
        <!--datatable-->
        <!--        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>-->
        <script src="<?php echo base_url() . 'assets/js/jquery.dataTables.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/dataTables.buttons.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/buttons.print.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/jszip.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/pdfmake.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/vfs_fonts.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/buttons.html5.min.js' ?>"></script>
        <!--js for chart-->
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/loader.js' ?>"></script>
        <!--ckeditor with image-->
        <script src="<?php echo base_url() . 'assets/ckeditor/ckeditor.js' ?>"></script>
        <!-- link for sweet alert -->
        <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
        <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />

            <!--//footer end-->
             <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>K</b>K</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Keral </b>Kart</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user"></i>
                                    <span class="hidden-xs"><?= $this->session->userdata('username'); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?= base_url(); ?>uploads/admin/avatar3.png" class="img-circle" alt="User Image">

                                        <p>
                                            Keral Kart Administrator
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?= base_url() ?>change-password" class="btn btn-warning  btn-flat">Change
                                                password</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= base_url() ?>logout" class="btn btn-danger btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <!--                            <li>
                                                            <a href="#" data-toggle="control-sidebar dropdown" class="dropdown-toggle"><i class="fa fa-gears"></i></a>
                                                        </li>-->
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?= base_url(); ?>uploads/admin/avatar3.png" class="img-circle" alt="User Image">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="pull-left info">
                            <p><?= $this->session->userdata('username'); ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <!--                    <form action="#" method="get" class="sidebar-form">
                                                <div class="input-group">
                                                    <input type="text" name="q" class="form-control" placeholder="Search...">
                                                    <span class="input-group-btn">
                                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </form>-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li>
                        <li>
                            <a href="<?= base_url() ?>dashboard">
                                <i class="fa fa-th"></i> <span>Dashboard</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-green">new</small>
                                </span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-gear"></i> <span>Master</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?= base_url(); ?>type"><i class="fa fa-circle-o"></i>Type Master</a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>category"><i class="fa fa-circle-o"></i>Category Master</a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>sub-category"><i class="fa fa-circle-o"></i>Sub-Category  Master</a>
                                </li>
                                <!--<li>-->
                                <!--    <a href="<?= base_url(); ?>brand"><i class="fa fa-circle-o"></i>Brand  Master</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="<?= base_url(); ?>gst"><i class="fa fa-circle-o"></i>GST  Master</a>-->
                                <!--</li>-->
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-gear"></i> <span>Product Master</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>product"><i class="fa fa-circle-o"></i>Publish Product</a></li>
                                <li><a href="<?= base_url() ?>product-list"><i class="fa fa-circle-o"></i>Manage Product</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-stack-exchange"></i> <span>Stock Master</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>add-stock"><i class="fa fa-circle-o"></i>Add Stock</a></li>
                                <li><a href="<?= base_url() ?>stock"><i class="fa fa-circle-o"></i>Manage Stock</a></li>
                                <li><a href="<?= base_url() ?>available-stock"><i class="fa fa-circle-o"></i>Available Quantity</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="<?= base_url() ?>contact-message">
                                <i class="fa fa-envelope"></i> <span>Customer Message/Faq</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right"><i class="fa fa-envelope"></i></small>
                                </span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i> <span>Customer Master</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>customer-list"><i class="fa fa-circle-o"></i>Manage Customer</a></li>
                            </ul>
                        </li>
                        <!-- <li>
                            <a href="<?= base_url() ?>stock">
                                <i class="fa fa-stack-exchange"></i> <span> Stock Master</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-yellow"><i class="fa fa-stack-exchange"></i></small>
                                </span>
                            </a>
                        </li> -->
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i> <span>Coupon Master</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>coupon"><i class="fa fa-circle-o"></i>Create Coupon</a></li>
                                <li><a href="<?= base_url() ?>coupon-manager"><i class="fa fa-circle-o"></i>Manage Coupon</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Report</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>get-all-stock"><i class="fa fa-circle-o"></i>Stock Report</a></li>
                                <li><a href="<?=base_url()?>get-all-orders"><i class="fa fa-circle-o"></i>Order Report</a></li>
                                <li><a href="<?=base_url()?>get-all-sales"><i class="fa fa-circle-o"></i>Sales Report</a></li>
                                <li><a href="<?=base_url()?>get-all-payments"><i class="fa fa-circle-o"></i>Payment Report</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-newspaper-o"></i> <span>Blog</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>blog"><i class="fa fa-circle-o"></i>publish Blog</a></li>
                                <li><a href="<?=base_url()?>blog-list"><i class="fa fa-circle-o"></i>Manage Blog</a></li>
                            </ul>
                        </li>


                        <!-- <li>
                            <a href="<?= base_url() ?>notification">
                                <i class="fa fa-bell"></i> <span>Notification</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-yellow"><i class="fa fa-bell"></i></small>
                                </span>
                            </a>
                        </li> -->

                        <li>
                            <a href="<?= base_url() ?>subscriber-list">
                                <i class="fa fa-envelope"></i> <span>Manage Subscriber</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right"><i class="fa fa-envelope"></i></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url() ?>manage-carousal">
                                <i class="fa fa-gear"></i> <span>Manage Carousal</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-purple"><i class="fa fa-image"></i></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url() ?>administration">
                                <i class="fa fa-gear"></i> <span>Administration</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-purple"><i class="fa fa-user"></i></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url() ?>change-password">
                                <i class="fa fa-lock"></i> <span>Change Password</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-green"><i class="fa fa-lock"></i></small>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>logout">
                                <i class="fa fa-sign-out"></i> <span>Logout</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-red">new</small>
                                </span>
                            </a>
                        </li>

                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php include_once $pageName . '.php'; ?>
            </div>
            <!-- /.content-wrapper -->
            <!--footer -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; <?= date('Y'); ?> <a href="http://hubrootsolutions.com"  target="_blank">Hubroot Solutions</a>.</strong> All rights
                reserved.
            </footer>



    </body>

</html>
