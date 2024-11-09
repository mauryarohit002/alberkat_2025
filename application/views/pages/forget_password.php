
<?php
    $this->load->view('templates/temp_header');
?>
<div class="login-page">
    <div class="login-box" style="margin: 4% auto">
        <div class="login-box-body" style="border:1px solid #c9766e;border-radius: 5px;">
            <div class="alert_msg"></div>
            <p class="login-box-msg">FORGET PASSWORD</p>
            <form id="user_forget_form" autocomplete="off">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control cust_ip_border_1" id="rm_parent_mob_no" name="rm_parent_mob_no" placeholder="MOBILE NUMBER">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <br>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control cust_ip_border_1" id="rm_sr_otp"   placeholder="ENTER OTP"  title="Enter OTP from your mobile">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
                <br>
                <div class="form-group has-feedback">
                    <input type="button" class="btn" value="SendOTP" onclick="send_otp()">
                </div>
                <br>
                <div id="confirm_pass">
                    
                </div>
               
                <div class="row">
                    <div class="col-xs-12">
                        <button type="button" class="btn btn-primary btn-block btn-flat" onclick="get_password()" style="background-color: #c9766e">Reset Password</button>
                        <br /><br />
                    </div><!-- /.col -->
                </div>    
            </form>
        </div>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<?php
    $this->load->view('templates/temp_footer');
?>
