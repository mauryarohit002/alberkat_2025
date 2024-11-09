
<?php
    $this->load->view('templates/temp_header');
?>
<div class="login-page">
    <div class="login-box" style="margin: 4% auto">
        <div class="login-box-body" style="border:1px solid #c9766e;border-radius: 5px;">
            <div class="alert_msg"></div>
            <p class="login-box-msg">ADMIN LOGIN</p>
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
                        <div class="pull-right hidden-xs">
                            <b>Powered by</b> Interlink Consultant
                            <br>
                            <!-- <a href="<?php echo base_url('chome/stud_registration')?>"><p class="pull-right">Register</p></a> -->
                        </div>
                    </div><!-- /.col -->
                </div>    
            </form>
        </div>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<?php
    $this->load->view('templates/temp_footer');
?>