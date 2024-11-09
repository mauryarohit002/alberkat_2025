<?php
  $user_id = $this->session->userdata('user_id');
  $role = $this->session->userdata('user_role_id');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Albarkaat School</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo assets('bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('plugins/select2/css/select2.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('plugins/pan/css/pan.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo assets('plugins/jvectormap/jquery-jvectormap-1.2.2.css')?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo assets('dist/css/AdminLTE.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo assets('dist/css/skins/_all-skins.min.css')?>" rel="stylesheet" type="text/css" />

    <link href="<?php echo assets('plugins/datepicker/datepicker.css')?>" rel="stylesheet" type="text/css" />
    
    <!-- daterange picker -->
    <link href="<?php echo assets('plugins/daterangepicker/daterangepicker-bs3.css')?>" rel="stylesheet" type="text/css" />
    <!-- dataTables -->
    <link href="<?php echo assets('plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets('admin/css/flexselect.css')?>" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="<?php echo assets('admin/css/master.css')?>" rel="stylesheet" type="text/css" />

    <link href="<?php echo assets('config/common.css')?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo assets('admin/css/style.css')?>">
    <script src="<?php echo assets('config/config.js')?>"></script>
    <script>
      var session_role = <?php echo $role; ?>
    </script>

  </head>
  <body class="skin-blue sidebar-mini fixed sidebar-collapse">

    <img src="<?php echo assets('images/loading.gif')?>" id="loading" />
    <!--************************************** Modal **************************************-->
    
      <div class="modal fade" id="popup_modal_lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <div class="modal fade" id="popup_modal_sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header">
              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
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

      <div class="container-fluid ">
        <div class="row top_bar">
          <div class="col-md-3 col-xs-12 logo">
              <a href="#">
                <img src="<?php echo assets('images/albarkaat_log.jpg')?>">
              </a>
          </div>
          <br><br>
          <div class="col-md-1 pull-right">
            <p><a href="<?php echo base_url('admin/clogin/logout')?>" class="btn btn-primary btn-flat cust_sign_out_btn" style="color:#fff;">Sign out</a></p>
          </div>
        </div>
      </div>
<div class="wrapper">

      <header class="main-header" style="position:absolute;">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
        
      </header>

      <?php
        $this->load->view('admin/templates/left_sidebar');
      ?>