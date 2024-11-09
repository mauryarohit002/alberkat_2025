
<?php
    $this->load->view('templates/temp_header');
?>
<div class="login-page">
    <div class="login-box" style="margin: 4% auto">
        <div class="login-box-body" style="border:1px solid #c9766e;border-radius: 5px;">
            <div class="alert_msg"></div>
            <p class="login-box-msg">USER LOGIN</p>
            <form id="user_login_form" autocomplete="off">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" id="user_mob" name="user_mob" placeholder="APPLICATION NUMBER">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <br>
                <div class="form-group has-feedback">
                    <input name="dob" id="dob" type="text" class="form-control" placeholder="Date of Birth" readonly="" />
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
                        <button type="button" class="btn btn-primary btn-block btn-flat" onclick="user_login()" style="background-color: #c9766e">Sign In</button>
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

<?php
    $this->load->view('templates/temp_footer');
?>
