<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AL-BARKAAT - Malik Muhammad Islam English School</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo assets('bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo assets('plugins/jvectormap/jquery-jvectormap-1.2.2.css')?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo assets('dist/css/AdminLTE.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo assets('dist/css/skins/_all-skins.min.css')?>" rel="stylesheet" type="text/css" />

    <link href="<?php echo assets('bootstrap/bootstrap_datepicker/css/bootstrap-datepicker.min.css')?>" rel="stylesheet" type="text/css" />
    
    <!-- daterange picker -->
    <!-- <link href="<?php echo assets('plugins/daterangepicker/daterangepicker-bs3.css')?>" rel="stylesheet" type="text/css" /> -->
    <!-- dataTables -->
    <link href="<?php echo assets('plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="<?php echo assets('css/master.css')?>" rel="stylesheet" type="text/css" />

    <link href="<?php echo assets('config/common.css')?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo assets('css/style.css')?>">
    <script src="<?php echo assets('config/config.js')?>"></script>
  </head>

  <body class="skin-blue sidebar-mini fixed sidebar-collapse" >

    <img src="<?php echo assets('images/loading.gif')?>" id="loading" />

    <img src="<?php echo assets('images/loader.gif')?>" id="loader" />
    
    <!--************************************** Modal **************************************-->
    
      <div class="modal fade" id="popup_modal_lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg cust_width">
          <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer">
              
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <div class="modal fade" id="popup_modal_sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title modal-title-sm"></h4>
            </div>
            <div class="modal-body modal-body-sm">
              
            </div>
            <div class="modal-footer modal-footer-sm">
              
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


    <!--************************************** Modal End **************************************-->

    <div class="">

      <!-- Header -->
    <div class="container-fluid ">
      <div class="row top_bar">
        <div class="col-md-4 col-xs-12 logo">
            <a href="#">
              <img src="<?php echo assets('images/albarkaat_log.jpg')?>">
            </a>
        </div>
        
        <h4 class="" style="padding-right: 15px;color:#1a1b1b;font-weight: bold;">
          <span style="color:#fff;float:right">SCHOOL CODE. 30252</span><br/>
          <span style="color:#fff;float:right">C.B.S.E. AFFILIATION NO. 1130375</span><br/>
        <span style="float:right;">Welcome : <?php echo $this->session->userdata('mob_no')?></span> </h4>
        <div class="col-md-8 col-xs-12 top_right_icon" style="padding-top: 0px;">
        
       
              <nav class="navbar navbar-default nav_custom">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                    </div>
                  <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav nav_custom_li">
                          <li class="pull-right"><a href="<?php echo base_url('chome/logout')?>">LOGOUT</a></li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
        </div>     
      </div>
    </div>
    <!-- Header ends -->
      <br/>

