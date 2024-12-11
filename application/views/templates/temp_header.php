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

    <!-- <link href="<?php echo assets('plugins/datepicker/datepicker.css')?>" rel="stylesheet" type="text/css" /> -->

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
    <!-- <link href="<?php echo assets('css/animate.css')?>" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

    <link href="<?php echo assets('config/common.css')?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo assets('css/style.css')?>">
    <script src="<?php echo assets('config/config.js')?>"></script>
    <script src="<?php echo assets('js/jssor.slider.min.js')?>"></script>
  </head>

  <body class="skin-blue sidebar-mini fixed sidebar-collapse" >

    <img src="<?php echo assets('images/loading.gif')?>" id="loading" />

    <img src="<?php echo assets('images/loader.gif')?>" id="loader" />

    <!--************************************** Modal **************************************-->

      <div class="modal fade" id="popup_modal_lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
        <div class="col-md-2 col-xs-12 logo" style="padding-left: 0px;padding-right: 0px;">
            <a href="<?php echo base_url('chome')?>">
              <img src="<?php echo assets('images/albarkaat_log.jpg')?>">
            </a>
        </div>

        <div class="col-md-10 col-xs-12 top_right_icon" style="padding-left: 0px;">
              <p style="text-align:right;padding-top:5px;color:#FFF">
                  <marquee width="60%" direction="left" style="color: #ffffff;text-shadow: 0 0 20px #000000;font-size: 16px;">
                      <!-- Nursery Admissions is closed due to full capacity of school. -->
                    Nursery Admissions will reopen on 16th Dec 2024 @11.00 am. All the best to all Admission Seekers.
                  </marquee>
                  C.B.S.E. AFFILIATION NO : 1130375  /  SCHOOL CODE : 30252
              </p>
              <nav class="navbar navbar-default nav_custom">
              <div class="container-fluid" style="padding-left: 0px;">
                <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar" style="color: #fff;background-color: #fff;"></span>
                        <span class="icon-bar" style="color: #fff;background-color: #fff;"></span>
                        <span class="icon-bar" style="color: #fff;background-color: #fff;"></span>
                    </button>
                  </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav nav_custom_li">
                        <li><a href="<?php echo base_url('chome')?>">HOME</a></li>
                        <li><a href="<?php echo base_url('chome/about_us')?>">ABOUT US</a></li>
                        <li><a href="<?php echo base_url('chome/gallery')?>">GALLERY</a></li>
                        <li><a href="<?php echo base_url('chome/privacy_policy')?>">POLICY</a></li>
                        <!-- <li><a href="<?php echo base_url('chome/refund_policy')?>">REFUND POLICY</a></li> -->
                        <li><a href="<?php echo base_url('chome/contact_us')?>">CONTACT US</a></li>
                        <li><a href="<?php echo base_url('chome/criteria')?>">ADMISSION CRITERIA 2025</a></li>
                        <li><a href="<?php echo base_url('chome/user_login')?>">EDIT APPLICATION</a></li>
                        <li><a href="<?php echo base_url('clogin/search')?>">TRACK APPLICATION</a></li>
                         <!--<li><a href="<?php echo base_url('chome/register')?>">REGISTER</a></li> -->
                        
                    </ul>
                  </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
              <!-- <marquee behavior="scroll" direction="left" style="color:#1a1717;font-weight: bold;">Last Date of Online Admission is extended up to 26th Jan 2019 till 5 pm.</marquee> -->
           <!--<marquee behavior="scroll" direction="left" style="color:#1a1717;font-weight: bold;">This is to hereby inform you that Nursery 2023-2024 online admission process has been extended upto 30th Dec 2021 till 4pm.</marquee>-->

            </nav>
        </div>
      </div>
    </div>


    <!-- Header ends -->
      <br/>

