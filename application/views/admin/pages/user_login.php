<?php
$this->load->view('admin/templates/header');
$role = $this->session->userdata("user_role_id");
?>
    <script>
        var link   =    "login";
        var sub_link = "login";
    </script>
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="padding-top:0px;background:#fff;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                EDIT Application
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <br>
                <div class="login-page">
    <div class="login-box" style="margin: 4% auto">
        <div class="login-box-body" style="border:1px solid #c9766e;border-radius: 5px;">
            <div class="alert_msg"></div>
            <p class="login-box-msg">USER LOGIN</p>
            <form id="user_login_form" autocomplete="off">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" id="user_mob" name="user_mob" placeholder="MOBILE NUMBER">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <br>
                <div class="form-group has-feedback">
                    <input name="dob" id="dob" type="text" class="form-control" placeholder="Date of Birth" />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <br>
                <div class="form-group has-feedback">
                    <input name="user_password" id="user_password" type="password" class="form-control" placeholder="Password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <br>
                <div class="row">

                    <div class="col-xs-12">
                        <button type="button" class="btn btn-primary btn-block btn-flat" onclick="admin_user_login()" style="background-color: #c9766e">Sign In</button>
                        <br /><br />
                    </div><!-- /.col -->

                   <!--  <div class="col-xs-6">
                        <a href="<?php echo base_url('chome/stud_registration')?>"><p class="pull-left">Register</p></a>
                    </div> -->
                    <div class="col-xs-12">
                        <a href="<?php echo base_url('chome/forget_password')?>"><p class="pull-right">Forget Password ? </p></a>
                    </div>
                </div>
            </form>
        </div>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
        </section>
       </div>

<?php
$this->load->view('admin/templates/footer');
?>
<script>
 $("#dob").datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        endDate: '30-09-2019',
        startDate: '01-10-2000',
    });