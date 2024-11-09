<?php $this->load->view('templates/temp_header') ?>
<div class="container-fluid">
    <div class="row">
       
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="text-center" style="font-weight: bold;">SEARCH APPLICATION STATUS</h4>
                        <div class="alert_msg"></div>
                        <form id="stud_app_search_form">
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control cust_ip_border_1" id="rm_parent_mob_no" name="rm_parent_mob_no" placeholder="APPLICATION NO" title="Enter Application Number">
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                            </div>
                            <br/>
                            <div class="form-group has-feedback">
                                 <input type="text" class="form-control cust_ip_border_1" name="rm_child_birth_date" id="rm_child_birth_date"  placeholder="CHILD'S BIRTH DATE"  title="Select Child's Birth Date" autocomplete="off">
                                <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                            </div>
                            <br/>
                            <div class="form-group has-feedback">
                                <input name="rm_password" id="rm_password" type="password" class="form-control cust_ip_border_1" placeholder="PASSWORD"/>
                              
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                            </div>
                            <br/>

                           <!--  <div class="form-group has-feedback">
                                <input type="button" class="btn" value="SendOTP" onclick="send_otp()">
                            </div> -->
                            <br/><br/>
                        </form>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="button" class="btn btn-primary btn-block btn-flat" onclick="search_student_app_status()" style="background-color: #c9766e">Search</button>
                                    <br /><br />
                                    
                                </div><!-- /.col -->
                                <div class="col-xs-12">
                                    <a href="<?php echo base_url('chome/forget_password')?>"><p class="pull-right">Forget Password ? </p></a>
                                </div>
                            </div> 
                    </div>
                </div>
            </div><!-- col-md-5 end -->

     
    </div>   
</div>
<?php 
    $this->load->view('templates/temp_footer');
?>