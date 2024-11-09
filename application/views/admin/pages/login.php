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

    <link href="<?php echo assets('config/common.css')?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo assets('admin/css/style.css')?>">
    <script src="<?php echo assets('config/config.js')?>"></script>
  </head>

  <body class="skin-blue sidebar-mini fixed sidebar-collapse login_bg">

    <img src="<?php echo assets('images/loading.gif')?>" id="loading" />
    
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



<div class="login-page">
    <div class="login-box" style="margin: 12% auto">
        <div class="login-box-body" style="background:transparent !important;">
            <div class="alert_msg"></div>
            <p class="login-box-msg" style="color: #fff;font-size: 16px;font-weight: bold;">ADMIN LOGIN</p>
            <form id="admin_login_form" autocomplete="off">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control form-control_login" id="user_name" name="user_name" aria-describedby="inputSuccess2Status" style="" placeholder="USER NAME">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <br>
                <div class="form-group has-feedback">
                    <input name="user_password" id="user_password" type="password" class="form-control" placeholder="Password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="button" class="btn btn-primary btn-block btn-flat" onclick="admin_login()" style="background-color: #c9766e">Sign In</button>
                        <br /><br />
                    </div><!-- /.col -->
                </div>    
            </form>
        </div>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo assets('plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo assets('bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo assets('plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>

    <script src="<?php echo assets('admin/js/login.js')?>" type="text/javascript"></script>

  
  </body>
</html>