<?php
    $this->load->view('templates/temp_header');
?>
  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-md-5 col-md-offset-1">
  				<div class="panel panel-default">
				  	<div class="panel-body">
				  		<!-- <img src="<?php echo assets('images/admission_criteria.jpeg')?>" class="img-fluid" style="width: 100%;"> -->

				  		<h4 class="text-center" style="margin-bottom: 30px;font-weight: bold;">GENERAL TERMS & CONDITIONS</h4>
					   	<p style="text-align: justify-all;">
					   		<b>1.</b>	The online application portal for Nursery will start from 25th December 2024 on the mentioned link: https://albarkaatadmissions.com/2025.<br/>
					   		<b>The above mentioned link will open on 25th Dec-24 @ 11 am & will close on 28th Feb-24 @ 4 pm.</b>
					   	</p>
					   	<p style="text-align: justify-all;">
							<b>2.</b>	Please read the instructions carefully before filling the online application.
					   	</p>
					   	<p style="text-align: justify-all;">
							<b>3.</b>	Admission is only for Nursery.
					   	</p>
					   	<p style="text-align: justify-all;">
							<b>4.</b>	Child /Applicant for whom admission is desired should be born between 01st Oct 2021 to 31st Dec 2022. (Inclusive for all the days)
					   	</p>
					   	<p style="text-align: justify-all;">
							<b>5.</b>	Compulsory Details/Documents to be uploaded.
					   	</p>
					   	<p style="text-align: justify-all;">
							&nbsp&nbsp&nbsp a.	Parent should register his own Mobile No & active E-mail ID; at the time of online application registration.
							<br/>
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp (Please Note registered Mobile no & E-mail ID will be used for further communications,
							<br/>
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp status updates, information with regards to your child’s application for admission.)
					   	</p>

					   	<p style="text-align: justify-all;">
							&nbsp&nbsp&nbsp b. Required Scanned Copy in (PDF Format only) of Municipal Birth Certificate of Child
							<br/>
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp in English Only.
					   	</p>
					   	<p style="text-align: justify-all;">
							&nbsp&nbsp&nbsp c.	Required Scanned Copy in (PDF Format only) of Child Aadhar Card/ Fathers
							<br/>
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Aadhar Card (Optional).
					   	</p>
					   	<p style="text-align: justify-all;">
							&nbsp&nbsp&nbsp d. Child/Applicant’s coloured photograph in (JPEG Format only) with white background
							<br/>
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp and size of 4.5 cm(L) X 3.5 cm(B) cm only to be properly uploaded in applicant’s photo place.
					   	</p>
					   		<p style="text-align: justify-all;">
							&nbsp&nbsp&nbsp e.	Father  & Mother Joint coloured photograph in (JPEG Format only) with white background
							<br/>
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp and size of   6.5 cm (L) X 4.5 cm (B) only to be properly uploaded in parents photo place.
					   	</p>
					   	</p>
					   		<p style="text-align: justify-all;">
							&nbsp&nbsp&nbsp f.	Both/One Parent must accompany the child for verification of required documents for the
							<br/>
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp admission procedures of Parents & Applicant Child.
					   	</p>
					   	</p>
					   		<p style="text-align: justify-all;">
							&nbsp&nbsp&nbsp g.	Parents must carry required original documents & 1 set of Xerox copies and
							<br/>
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp above mentioned size coloured photographs of child & joint photo of father and mother.
					   	</p>
					   	<p style="text-align: justify-all;">
							<b>7.</b>Please do not disturb the School authority during the entire application process.
					   	</p>
					   	<p style="text-align: justify-all;">
							<b>8.</b>Admission application registration fees Rs, 1000/-(Non-Refundable) will be accepted through online payment system only.
					   	</p>

					   	<p style="text-align: justify-all;">
					   		<b>9.</b>Please keep your debit card, credit card details ready before you start filling form.
					   	</p>
					   	<p style="text-align: justify-all;">
							<b>10.</b>In case of any dispute regarding payment gateway service, please contact your bank branch.
					   	</p>
					   	<p>
							<b>NOTE: FILLING IN OF THE PRELIMINARY FORM DOES NOT ASSURE ADMISSION TO NURSERY.</b>
					   	</p>
					   	<br>
				  	</div>
				</div>
  			</div>

  			<div class="col-md-5">
  				<div class="panel panel-default">
				  	<div class="panel-body">
				    	<h4 class="text-center" style="font-weight: bold;">REGISTRATION</h4>
				    	<div class="alert_msg"></div>
                    	<form id="stud_reg_form">
	                    	<div class="form-group has-feedback">
	                        	<input type="text" class="form-control cust_ip_border_1" id="rm_parent_mob_no" name="rm_parent_mob_no" placeholder="MOBILE" title="Enter Mobile Number" autocomplete="off">
	                        	<span class="glyphicon glyphicon-phone form-control-feedback"></span>
	                    	</div>
	                    	<br/>
	                    	<div class="form-group has-feedback">
	                        	<input type="text" class="form-control cust_ip_border_1" id="rm_child_family_email_id" name="rm_child_family_email_id" placeholder="Email ID" title="Enter Email ID" autocomplete="off">
	                        	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	                    	</div>
	                    	<br/>
	                    	<div class="form-group has-feedback">
	                        	 <input type="text" class="form-control cust_ip_border_1" name="rm_child_birth_date" id="rm_child_birth_date"  placeholder="CHILD'S BIRTH DATE"  title="Select Child's Birth Date" autocomplete="off" onchange="change_child_class()" readonly="">
	                        	<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
	                    	</div>
	                    	<br/>
	                    	<div class="form-group has-feedback">
	                        	 <input type="text" class="form-control cust_ip_border_1" name="rm_child_aadhar_no" id="rm_child_aadhar_no"  placeholder="CHILD'S AADHAR CARD NO" autocomplete="off"/>
	                        	<span class="glyphicon glyphicon-pencil form-control-feedback"></span>
	                    	</div>
	                    	<br/>
	                    	<div class="form-group has-feedback">
	                        	<input type="password" class="form-control cust_ip_border_1" id="rm_password" name="rm_password"  placeholder="PASSWORD (minimum 6 characters)"  title="Enter Password" autocomplete="off">
	                        	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	                    	</div>
	                    	<br/>
	                    	<div class="form-group has-feedback">
	                        	<input type="password" class="form-control cust_ip_border_1" id="rm_confirm_password"   placeholder="CONFIRM PASSWORD" onkeyup="check_cpassword()" title="Enter Confirm Password" autocomplete="off">
	                        	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	                    	</div>
	                    	<br/>
	                    	<div class="form-group has-feedback">
	                    		<select class="form-control cust_ip_border_1" id="rm_child_class" name="rm_child_class">
	                    			<option value="NURSERY">NURSERY</option>
	                    			<option value="JRKG">JR KG</option>
	                    			<option value="SRKG">SR KG</option>
	                    			<option value="I">I</option>
	                    			<option value="II">II</option>
	                    			<option value="III">III</option>
	                    			<option value="IV">IV</option>
	                    			<option value="V">V</option>
	                    			<option value="VI">VI</option>
	                    			<option value="VII">VII</option>
	                    			<option value="VIII">VIII</option>
	                    			<option value="IX">IX</option>
	                    			<option value="X">X</option>
	                    		</select>
	                    		 <!--<input type="hidden" class="form-control cust_ip_border_1" id="rm_child_class1" name="rm_child_class" value="NURSERY">-->
	                        	<span class="glyphicon glyphicon-education form-control-feedback"></span>
	                    	</div>
	                    	<br/>
	                    	<div class="form-group has-feedback">
	                        	<!-- <div onclick="captcha()" style="cursor: pointer;" title="Click here to Change CAPTCHA">
	                                <span  style="font-weight: bold;">CAPTCHA:</span>
	                                <span id="cap_no" style="font-weight: bold;padding-left: 12px;color: #C9766E;font-size: 20px;background: #f1f1f1;padding: 6px;"></span>
	                                <span class="glyphicon glyphicon-refresh form-control-feedback form-control_icon" aria-hidden="true" style="margin-right:10px;cursor: pointer;color: #C9766E;" ></span>
	                            </div> -->

	                    	</div>
	                    	<br/>
	                    	<div class="form-group has-feedback" style="display: none;" id="captcha_box">
	                        	<input type="text" class="form-control cust_ip_border_1"  id="cap_data"  placeholder="ENTER THE OTP SENT ON WHATSAPP/E-MAIL" title="Enter the OTP" autocomplete="off">
	                        	<!-- this cap_data_type is represent as registration from website -->
	                            <input type="hidden" class="form-control"  id="cap_data_type" value="1">
	                        	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	                    	</div>
	                    	<br/>
	                    <!--	<div class="form-group has-feedback">
	                        	<input type="text" class="form-control cust_ip_border_1" id="rm_sr_otp"   placeholder="ENTER OTP"  title="Enter OTP from your mobile" autocomplete="off">
	                        	<span class="glyphicon glyphicon-phone form-control-feedback"></span>
	                    	</div>-->
	                    	<!-- <br/> -->

	                        	<!-- <input type="button" class="btn" value="SendOTP" onclick="send_otp()"> -->
	                    	<div class="form-group has-feedback" style="display: none;">
	                        	<input type="button" class="btn btn-primary btn-block btn-flat" id="send_capta_btn" value="SEND OTP" onclick="captcha()" style="background-color:#c9766e;">
	                    	</div>
	                    	<br/><br/>
	                    	<div class="row" style="/*display: none;*/" id="register_btn">
			                    <div class="col-xs-12">
			                        <button type="button" class="btn btn-primary btn-block btn-flat" onclick="register_student()" style="background-color: #c9766e">REGISTER</button>
			                        <br/><br/><br/><br/>
			                    </div>
	                		</div>
	                    </form>
				  	</div>
				</div>
  			</div><!-- col-md-5 end -->

  			<div class="col-md-1"></div>
  		</div>
  	</div>
<?php

$this->load->view('templates/temp_footer');
?>
