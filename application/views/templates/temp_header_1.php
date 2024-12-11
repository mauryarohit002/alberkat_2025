<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>AL-BARKAAT - Malik Muhammad Islam English School</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo assets('plugins/jvectormap/jquery-jvectormap-1.2.2.css')?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo assets('dist/css/AdminLTE.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('dist/css/skins/_all-skins.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- Datepicker -->
    <link href="<?php echo assets('bootstrap/bootstrap_datepicker/css/bootstrap-datepicker.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="<?php echo assets('plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
    <!-- Master and Custom Styles -->
    <link href="<?php echo assets('css/master.css')?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link href="<?php echo assets('config/common.css')?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo assets('css/style.css')?>">
    <script src="<?php echo assets('config/config.js')?>"></script>
    <script src="<?php echo assets('js/jssor.slider.min.js')?>"></script>
  </head>
<style>
    @media (min-width: 992px) {
    .navbar-expand-lg .navbar-nav {
        flex-direction: row;
        justify-content: space-evenly;
    }
}
</style>
  <body class="skin-blue sidebar-mini fixed sidebar-collapse">

    <img src="<?php echo assets('images/loading.gif')?>" id="loading" />
    <img src="<?php echo assets('images/loader.gif')?>" id="loader" />

    <!-- Modal -->
    <div class="modal fade" id="popup_modal_lg" tabindex="-1" aria-labelledby="popup_modal_lg_Label" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>

    <div class="">

      <!-- Header -->
      <div class="container-fluid">
        <div class="row top_bar">
          <div class="col-md-2 col-xs-12 logo" style="padding-left: 0px; padding-right: 0px;">
            <a href="<?php echo base_url('chome')?>">
              <img src="<?php echo assets('images/albarkaat_log.jpg')?>" alt="Logo">
            </a>
          </div>

          <div class="col-md-10 col-xs-12 top_right_icon" style="padding-left: 0px;">
            <p class="mb-0" style="text-align:right;padding-top:5px;color:#FFF">
              <marquee width="60%" direction="left" style="color:#000;">
                Nursery Admissions will reopen on 25th Dec 2024 @11.00 am. All the best to all Admission Seekers.
              </marquee>
              C.B.S.E. AFFILIATION NO : 1130375  /  SCHOOL CODE : 30252
            </p>
            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="container-fluid w-100 justify-content-end">
                <!-- Brand and toggle for mobile view -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white fs-6" href="<?php echo base_url('chome')?>">HOME</a></li>
                    <li class="nav-item"><a class="nav-link text-white fs-6" href="<?php echo base_url('chome/about_us')?>">ABOUT US</a></li>
                    <li class="nav-item"><a class="nav-link text-white fs-6" href="<?php echo base_url('chome/gallery')?>">GALLERY</a></li>
                    <li class="nav-item"><a class="nav-link text-white fs-6" href="<?php echo base_url('chome/privacy_policy')?>">POLICY</a></li>
                    <li class="nav-item"><a class="nav-link text-white fs-6" href="<?php echo base_url('chome/contact_us')?>">CONTACT US</a></li>
                    <li class="nav-item"><a class="nav-link text-white fs-6" href="<?php echo base_url('chome/criteria')?>">ADMISSION CRITERIA 2024</a></li>
                    <li class="nav-item"><a class="nav-link text-white fs-6" href="<?php echo base_url('chome/user_login')?>">EDIT APPLICATION</a></li>
                    <li class="nav-item"><a class="nav-link text-white fs-6" href="<?php echo base_url('clogin/search')?>">TRACK APPLICATION</a></li>
                    <li class="nav-item"><a class="nav-link text-white fs-6" href="<?php echo base_url('chome/register')?>">REGISTER</a></li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
      <!-- Header ends -->