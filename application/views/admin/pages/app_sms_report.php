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
                  <br>
                  <table class="table table-striped">
                      <tr>
                          <th width="10%">Sr No.</th>
                          <th width="15%">App Status</th>
                          <th width="15%">Sent Date</th>
                          <th width="10%">SMS Staus</th>
                          <th width="50%">Messages</th>
                      </tr>
                       <?php
                        foreach ($sms_data as $key => $value):
                      ?>
                      <tr>
                        <td><?php echo $key+1?></td>
                        <td>
                          <?php 
                            $status = $value['msg_app_status'];

                                switch ($status) {
                                    case "0":
                                        echo "Pending";
                                        break;
                                    case "1":
                                        echo "Incomplete Application";
                                        break;
                                    case "2":
                                        echo "Photo Not Proper";
                                        break;
                                    case "3":
                                        echo "Payment Not Done";
                                        break;
                                    case "4":
                                        echo "Application Print Done";
                                        break;
                                    case "5":
                                        echo "Verification Schedule";
                                        break;
                                    case "6":
                                        echo "Application Rejected";
                                        break;
                                    case "7":
                                        echo "Admission Confirm";
                                        break;
                                    case "8":
                                        echo "Provisional Selection";
                                        break;
                                    case "9":
                                        echo "Absent For Interview";
                                        break;
                                    case "100":
                                        echo "Custom SMS";
                                        break;
                                    default:
                                        echo "Status Not available";
                                }
                          ?>
                        </td>
                        <td><?php echo date('d-m-Y H:i:s',strtotime($value['msg_send_date']))?></td>
                        <td>
                          <?php
                            if ($value['msg_status'] == 1) 
                            {
                              echo "success";
                            } 
                            else 
                            {
                               echo "fail";
                            }
                          ?>
                        </td>
                        <td><?php echo $value['msg_content']?></td>
                      </tr>
                      <?php
                        endforeach;
                      ?>
              </table>
              </div>
          </div>
        </div>
      </div>   
  </div>
</body>
</html>