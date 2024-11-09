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

        <link href="<?php echo assets('css/master.css')?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo assets('config/common.css')?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo assets('css/style.css')?>">
        <script src="<?php echo assets('config/config.js')?>"></script>
    </head>

    <body>
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

    <div class="">
      <!-- Header -->
    <div class="container-fluid ">
      <div class="row top_bar">
        <div class="col-md-3 col-xs-12 logo">
          <a href="#">
            <img src="<?php echo assets('images/albarkaat_log.jpg')?>">
          </a>
        </div>
        <br><br>
      </div>
    </div>
    <!-- Header ends -->
    <br/>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-body">
                    <div class="col-sm-4">
                      <h5 style="font-weight: bold;">
                      STUDENT NAME : <?php echo $student_data[0]['rm_child_name']." ".$student_data[0]['rm_child_father_name']." ".$student_data[0]['rm_child_surname']?></h5>
                      <h5 style="font-weight: bold;">MOBILE NO : <?php echo $student_data[0]['rm_parent_mob_no']?></h5>
                    </div>

                    <div class="col-sm-4"> 
                      <h4 class="text-center" style="font-weight: bold;">APPLICATION SMS REPORT - (<?php echo $student_data[0]['rm_app_no']?>) </h4>
                    </div>
                  <br><br><br><br>
                  <table class="table table-striped">
                      <tr align="center">
                          <th width="25%" align="center">CHILD PHOTO - <a href="<?php echo uploads($student_data[0]['rm_child_photo'])?>" target="_blank">DOWNLOAD <span><img src="<?php echo assets('images/download.png')?>"></span></a></th>

                          <th width="25%" align="center">FAMILY PHOTO - <a href="<?php echo uploads($student_data[0]['rm_child_family_photo'])?>" target="_blank">DOWNLOAD <span><img src="<?php echo assets('images/download.png')?>"></span></a></th>

                          <th width="25%" align="center">CHILD BIRTH CERTIFICATE - <a href="<?php echo uploads($student_data[0]['rm_child_birth_certi_photo'])?>" target="_blank">DOWNLOAD <span><img src="<?php echo assets('images/download.png')?>"></span></a></th>
                          
                          <th width="25%" align="center">CHILD AADHAR CARD - <a href="<?php echo uploads($student_data[0]['rm_child_aadhar_card_photo'])?>" target="_blank">DOWNLOAD <span><img src="<?php echo assets('images/download.png')?>"></span></a></th>
                      </tr>
                     
              </table>
              </div>
          </div>
        </div>
      </div>   
  </div>
</body>
</html>