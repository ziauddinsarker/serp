<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>S.S Enterprise</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css" />

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url("assets/vendor/metisMenu/metisMenu.min.css"); ?>" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/dist/css/sb-admin-2.css"); ?>" rel="stylesheet" type="text/css" />

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url("assets/vendor/morrisjs/morris.css"); ?>" rel="stylesheet" type="text/css" />

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/vendor/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css" />

    <!-- Include External CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">


    <!-- Navigation -->

    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=  base_url()?>">S.S Enterprise</a>
        </div>
        <!-- /.navbar-header -->
       <ul class="nav navbar-top-links navbar-right">

        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?= site_url('logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
        </ul>



        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="<?=  base_url()?>"><i class="fa fa-dashboard fa-fw"></i> Main</a>
                    </li>
                    <li>
                        <a href="<?=  base_url()?>dashboard/invoice"><i class="fa fa-dashboard fa-fw"></i> Invoice</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-dropbox fa-fw"></i>Product<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=  base_url()?>dashboard/product_list"><i class="fa fa-list"></i> <span>Product List</span></a>
                            </li>
                            <li>
                                <a href="<?=  base_url()?>dashboard/add_product_group"><i class="fa fa-list"></i> <span>Product Category</span></a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Sales<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=  base_url()?>dashboard/invoice_list">Invoices</a>
                            </li>
                            <li>
                                <a href="morris.html">Today's Sale</a>
                            </li>
                            <li>
                                <a href="morris.html">Today's Credit Sale</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-dropbox fa-fw"></i>Stock<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=  base_url()?>dashboard/stock_list"><i class="fa fa-list"></i> <span>Stock List</span></a>
                            </li>
                            <li>
                                <a href="<?=  base_url()?>dashboard/add_product_stock"><i class="fa fa-list"></i> <span>Add Stock</span></a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-home fa-fw"></i>Shop<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=  base_url()?>dashboard/shop_list"><i class="fa fa-list"></i> <span>Shop List</span></a>
                            </li>
                            <li>
                                <a href="<?=  base_url()?>dashboard/add_shop_group""><i class="fa fa-list"></i><span>Shop Group</span></a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-home fa-fw"></i>Company<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=  base_url()?>dashboard/company_list"><i class="fa fa-list"></i> <span>Company List</span></a>
                            </li>
                            <li>
                                <a href="<?=  base_url()?>dashboard/add_company_to_list"><i class="fa fa-list"></i> <span>Add New Company</span></a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>Expenditure<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="panels-wells.html">Panels and Wells</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>


                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
