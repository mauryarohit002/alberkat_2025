<?php
$this->load->view('admin/templates/header');
$role = $this->session->userdata("user_role_id");
?>
    <script>
        var link = "search";
        var sub_link = "search";
    </script>
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="padding-top:0px;background:#fff;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Application Status
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">
                Application Status</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <br>
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="text-center" style="font-weight: bold;">SEARCH APPLICATION STATUS</h4>
                        <div class="alert_msg"></div>
                        <form id="stud_app_search_form">
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control cust_ip_border_1" id="rm_parent_mob_no" name="rm_parent_mob_no" placeholder="MOBILE" title="Enter Mobile Number">
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                            </div>
                            <br/>
                            <div class="form-group has-feedback">
                                 <input type="text" class="form-control cust_ip_border_1 dash_date_search" name="rm_child_birth_date" id="rm_child_birth_date"  placeholder="CHILD'S BIRTH DATE"  title="Select Child's Birth Date" autocomplete="off">
                                <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                            </div>
                            <br/>
                        </form>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="button" class="btn btn-primary btn-block btn-flat" onclick="search_student_app_status()" style="background-color: #c9766e">Search</button>
                                    <br /><br />
                                    
                                </div><!-- /.col -->
                            </div> 
                    </div>
                </div>
            </div><!-- col-md-5 end -->
        </section>
       </div>
       
<?php
$this->load->view('admin/templates/footer');
?>