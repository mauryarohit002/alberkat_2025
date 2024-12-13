<?php
    $this->load->view('templates/temp_form_header');

    // echo "<pre>";print_r($student_data);exit();
    // $reg_id = encrypt_decrypt("decrypt", $id, SECRET_KEY);
    // echo $reg_id;exit()
?>
  	<div class="container-fluid">
	  		<!-- <div class="container"><h1>Bootstrap  tab panel example (using nav-pills)  </h1></div> -->
	  		<?php 
	  			if ($student_data[0]['rm_app_status'] == '0'):
	  		?>
	  			<div class="pull-right"><button class="btn btn-primary" onClick="print_appl(<?php echo $student_data[0]['rm_id']?>)">Download PDF</button></div>
	  			
	  		<?php 
	  			endif;
	  		?>

			<div id="exTab1" class="container">	
				<ul  class="nav nav-pills row cust_nav_pills">
					<li class="col-md-6 active" id="stu_det" style="padding-left: 0px;padding-right: 0px;width: 48%;text-align: center;" onclick="show_arrow(1)">
			        	<a  href="#a1a" data-toggle="tab">STUDENT DETAILS <span style="float: right;" id="arrow_img_rg"><img src="<?php echo assets('images/arrowrg.png')?>" class="img-responsive" style="width: 90px;margin-top: -12px;"></span></a>
			        	
					</li>
					<li class="col-md-6" id="fam_det" style="padding-left: 0px;padding-right: 0px;width: 48%;text-align: center;" onclick="show_arrow(2)">
						<a href="#a2a" data-toggle="tab"><span style="float: left;" id="arrow_img_lf"><img src="<?php echo assets('images/arrowlf.png')?>" class="img-responsive" style="width: 90px;margin-top: -12px;"></span> FAMILY PARTICULARS</a>
						
					</li>
				</ul>

				<form class="form-horizontal" id="student_details_form" enctype="multipart/form-data">
				<div class="alert_msg"></div>
				<div class="tab-content clearfix" id="ip_uppercase" style="margin-left: -15px;margin-right: -15px;">

				  	<div class="tab-pane active" id="a1a">
	          			<!-- <h3>Content's background color is the same for the tab</h3> -->
	          				<div class="form-group">
	                            <label for="inputEmail3" class="col-md-2 control-label">Application No.</label>
	                            <div class="col-md-3 col-xs-12">
	                            	<input type="text" class="form-control cust_ip_border" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_app_no'])?>" placeholder="APPLICATION NO" title="APPLICATION NO" readonly/>
	                            </div>
	                            <div class="col-md-6 col-xs-12" style="margin-top: 8px;padding-left: 0px;">
	                            	<span style="color: red;">NOTE: This application no is important please note down it.</span>
	                            </div>
	                        </div>

	          				<br>
		          			<div class="form-group">
	                            <label for="inputEmail3" class="col-md-2 control-label">Date</label>
	                            <div class="col-md-3 col-xs-12">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_reg_date" id="rm_reg_date" value="<?php echo (empty($student_data)?date("d-m-Y"):date('d-m-Y',strtotime($student_data[0]['rm_reg_date'])))?>" readonly/>
	                            </div>
	                            <label for="inputEmail3" class="col-md-2 col-md-offset-2 control-label">Aadhar Card No.</label>
	                            <div class="col-md-2">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_aadhar_no" id="rm_child_aadhar_no" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_aadhar_no'])?>" placeholder="AADHAR NO" title="Aadhar No." readonly/>
	                            </div>
	                        </div>
                       		<br>
                        	<div class="form-group">
                            	<label for="inputEmail3" class="col-md-2 control-label">Name</label>
                            	<div class="col-md-3 col-xs-12">
                            		<input type="text" class="form-control cust_ip_border" name="rm_child_surname" id="rm_child_surname" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_surname'])?>" placeholder="SURNAME" title="Surname" onkeyup="set_sur_name(this.value)"/>
                            	</div>
	                            <div class="col-md-3 col-xs-12">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_name" id="rm_child_name" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_name'])?>" placeholder="CHILD NAME" title="Child Name"/>
	                            </div>
	                            <div class="col-md-3 col-xs-12">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_father_name" id="rm_child_father_name" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_father_name'])?>" placeholder="FATHER NAME" title="Father Name" onkeyup="set_father_name(this.value)"/>
	                            </div>
	                            <div class="col-md-3 col-md-offset-2 col-xs-12">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_mother_name" id="rm_child_mother_name" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_mother_name'])?>" placeholder="MOTHER NAME" title="Mother Name" onkeyup="set_mother_name(this.value)"/>
	                            </div>
                        	</div>
                        	<br>
	                        <div class="form-group">
	                        	<label for="inputEmail3" class="col-md-2 control-label">Gender</label>
	                        	<div class="col-md-2 col-xs-12">
	                            	<label class="radio-inline">
	                                    <input type="radio" name="rm_child_gender" class="gender_class" value="M" <?php echo (empty($student_data))?'':(($student_data[0]['rm_child_gender'] == "M")?"checked":"") ?> >Male
	                                </label>
	                                <label class="radio-inline">
	                                    <input type="radio" name="rm_child_gender" class="gender_class" value="F" <?php echo (empty($student_data))?'': (($student_data[0]['rm_child_gender'] == "F")?"checked":"")?> >Female
	                                </label>
	                            </div>
	                            <label for="inputEmail3" class="col-md-1 control-label">Date of Birth</label>
	                        	<div class="col-md-3 col-xs-12">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_birth_date" value="<?php echo (empty($student_data)?'':date('d-m-Y',strtotime($student_data[0]['rm_child_birth_date'])))?>" placeholder="DATE OF BITRH" title="Date of Bitrh" readonly/>
	                            </div>
	                        </div>
	                        <br>
	                        <div class="form-group">
	                            <label for="inputEmail3" class="col-md-2 control-label">Place of Birth</label>
	                            <div class="col-md-3">
	                            	
	                            <input type="text" class="form-control cust_ip_border" name="rm_child_birth_town" id="rm_child_birth_town" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_birth_town'])?>" placeholder="TOWN / CITY" title="Town / City"/>
	                            </div>

	                            <div class="col-md-3">
	                            	
	                            <input type="text" class="form-control cust_ip_border" name="rm_child_birth_state" id="rm_child_birth_state" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_birth_state'])?>" placeholder="STATE" title="State"/>
	                            </div>
	                        </div>
	                        <br>
	                        <div class="form-group">
	                        	<label for="inputEmail3" class="col-md-2 control-label">Nationality</label>
	                        	<div class="col-md-3 col-xs-12">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_nationality" id="rm_child_nationality" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_nationality'])?>" placeholder="NATIONALITY" title="Nationality"/>
	                            </div>
	                        </div>
	                        <br>
	                        <div class="form-group">
	                        	<label for="inputEmail3" class="col-md-2 control-label">Religion</label>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_religion" id="rm_child_religion" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_religion'])?>" placeholder="RELIGION" title="Religion"/>
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_community" id="rm_child_community" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_community'])?>" placeholder="COMMUNITY" title="Community"/>
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_mother_tongue" id="rm_child_mother_tongue" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_mother_tongue'])?>" placeholder="MOTHER TONGUE" title="Mother Tongue"/>
	                            </div>
	                        </div>
                        	<br>
	                        <div class="form-group">
	                        	<label for="inputEmail3" class="col-md-2 control-label">Permanent Address <br> <span style="color: red;font-weight: normal;">(max 165 characters)</span> </label>
	                            <div class="col-md-3">
	                            	<textarea  class="form-control cust_ip_border" name="rm_child_per_add_house_no" id="rm_child_per_add_house_no" placeholder="HOUSE No., STREET NAME" title="House no.,Street Name" row="3" maxlength="165"><?php echo (empty($student_data)?'':$student_data[0]['rm_child_per_add_house_no'])?></textarea>
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_per_add_town" id="rm_child_per_add_town" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_per_add_town'])?>" placeholder="TOWN / CITY" title="Town ? City"/>
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_per_add_pin_code" id="rm_child_per_add_pin_code" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_per_add_pin_code'])?>" placeholder="PINCODE" title="Pincode"/>
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_per_add_state" id="rm_child_per_add_state" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_per_add_state'])?>" placeholder="STATE" title="state"/>
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_per_add_municipality_ward" id="rm_child_per_add_municipality_ward" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_per_add_municipality_ward'])?>" placeholder="MUNICIPALITY WARD (Eg. Ward L)" title="Municipality ward (Eg. Ward L)"/>
	                            </div>
	                        </div>
                        	<br>
	                        <div class="form-group">
	                        	<div class="col-md-2">
	                                <label class="control-label">Temporary Address <br> <span style="color: red;font-weight: normal;">(max 165 characters)</span></label><br>
	                                <b>Same as above</b>&nbsp;<input type="checkbox" class="add_copy" name="rm_child_tmp_add_same_as_per">
	                            </div>
	                            <div class="col-md-3">
	                                <textarea  class="form-control cust_ip_border" name="rm_child_temp_add_house_no" id="rm_child_temp_add_house_no" placeholder="HOUSE No., STREET NAME" title="House no.,Street Name" row="3" maxlength="165"><?php echo (empty($student_data)?'':$student_data[0]['rm_child_temp_add_house_no'])?></textarea>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_temp_add_town" id="rm_child_temp_add_town" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_temp_add_town'])?>" placeholder="TOWN / CITY" title="Town ? City"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_temp_add_pin_code" id="rm_child_temp_add_pin_code" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_temp_add_pin_code'])?>" placeholder="PINCODE" title="Pincode"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_temp_add_state" id="rm_child_temp_add_state" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_temp_add_state'])?>" placeholder="STATE" title="state"/>
	                            </div>
	                        </div>
	                        <br>
	                        <div class="form-group">
	                            <label class="col-md-2 control-label">Languages Spoken at Home</label>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_lng_spkn_at_home_1" id="rm_child_lng_spkn_at_home_1" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_lng_spkn_at_home_1'])?>" placeholder="FIRST" title="First"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_lng_spkn_at_home_2" id="rm_child_lng_spkn_at_home_2" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_lng_spkn_at_home_2'])?>" placeholder="SECOND" title="Second"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_lng_spkn_at_home_3" id="rm_child_lng_spkn_at_home_3" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_lng_spkn_at_home_3'])?>" placeholder="THIRD" title="Third"/>
	                            </div>
	                        </div>
	                        <br>
	                        <div class="form-group" >
	                        	<label class="col-md-2 control-label">If Pre-School Attended</label>
	                            <div class="col-md-3">
	                                <select class="form-control cust_ip_border" name="rm_child_pre_school_attend" id="rm_child_pre_school_attend" onchange="get_school_name_ip(this.value);">
	                                    <option value="0">Please Select</option>
	                                    <option value="YES" <?php echo $student_data[0]['rm_child_pre_school_attend'] == 'YES'?"selected":"" ?>>Yes</option>
	                                    <option value="NO"  <?php echo $student_data[0]['rm_child_pre_school_attend'] == 'NO'?"selected":"" ?>>No</option>
	                                </select>
	                            </div>
	                            <div class="col-md-3" id="pre_school_ip">
	                                <?php if  (empty($student_data)?'':$student_data[0]['rm_child_pre_school_attend']== 'YES'):?>
	                                    <input type="text" id="rm_child_pre_school_name" name="rm_child_pre_school_name" value="<?php echo (empty($student_data[0]['rm_child_pre_school_name'])?"":$student_data[0]['rm_child_pre_school_name']) ?>" class="form-control">
	                                <?php endif; ?>    
	                            </div>
	                        </div>
	                        <br>
	                        <br>
	                        <div class="form-group">
	                            <div class="col-sm-9 col-sm-offset-3">
	                                <b style="color: red"><i>Child,Parent Photo size should be 4.5 cm(L) X 3.5 cm(B) (413x531 pixels) and less than 500KB (with white background)</i></b><br/>
	                                <b style="color: red"><i>Birth Certificate,Aadhar Card only in PDF Format</i></b>
	                            </div>
	                        </div>
	                        <div class="form-group" >
	                            <div class="col-md-2">
	                                <label class="control-label">Please Attach Latest Photograph of</label>
	                            </div>
	                            <div class="col-md-2" >
	                                <label class="control-label">Child Photo (jpg, jpeg )</label>
									<input type="file" class="form-control"  id="rm_child_photo" name="rm_child_photo"  title="Child" onchange="putImage('rm_child_photo','child_target')" style="border: none;padding: 5px 0px;">
									<input type="text" name="rm_child_photo_path" value="<?php echo (empty($student_data[0]['rm_child_photo'])?"":$student_data[0]['rm_child_photo']) ?>" style="border:none;font-size: 10px;width: 100%;" readonly/>
									
									<?php 
										if (!empty($student_data)):
										?>
										<img id="child_target" src="<?php echo base_url('public/uploads/product/'); ?><?php echo "/".$student_data[0]['rm_child_photo'] ?>" class="img-responsive" onclick="open_model_img(this,'CHILD PHOTO')"/>
									<?php 
										endif;
									?>
	                            </div>
	                            <div class="col-md-2" >
									<label class="control-label">Mother Photo (jpg, jpeg )</label>
									<input type="file" class="form-control" id="rm_child_mother_photo" name="rm_child_mother_photo" title="Mother" onchange="putImage('rm_child_mother_photo','mother_target')" style="border: none;padding: 5px 0px;">
									<input type="text" name="rm_child_mother_photo_path" value="<?php echo (empty($student_data[0]['rm_child_mother_photo'])?"":$student_data[0]['rm_child_mother_photo']) ?>" style="border:none;font-size: 10px;width: 100%;" readonly/>
									<?php 
										if (!empty($student_data)):
									?>
										<img src="<?php echo base_url('public/uploads/product/'); ?><?php echo "/".$student_data[0]['rm_child_mother_photo'] ?>" id="mother_target" class="img-responsive" onclick="open_model_img(this,'MOTHER PHOTO')"/>
									<?php 
										endif;
									?>
	                            </div>
								<div class="col-md-2" >
									<label class="control-label">Father Photo (jpg, jpeg )</label>
									<input type="file" class="form-control" id="rm_child_father_photo" name="rm_child_father_photo" title="Father" onchange="putImage('rm_child_father_photo','father_target')" style="border: none;padding: 5px 0px;">
									<input type="text" name="rm_child_father_photo_path" value="<?php echo (empty($student_data[0]['rm_child_father_photo'])?"":$student_data[0]['rm_child_father_photo']) ?>" style="border:none;font-size: 10px;width: 100%;" readonly/>
									<?php 
										if (!empty($student_data)):
									?>
										<img src="<?php echo base_url('public/uploads/product/'); ?><?php echo "/".$student_data[0]['rm_child_father_photo'] ?>" id="father_target" class="img-responsive" onclick="open_model_img(this,'FATHER PHOTO')"/>
									<?php 
										endif;
									?>
	                            </div>
	                            <div class="col-md-2">
	                                <label class="control-label">Birth Certificate ( pdf )</label>  
	                                <input type="file" id="rm_child_birth_certi_photo" name="rm_child_birth_certi_photo" class="form-control" title="Birth Certificate" style="border: none;padding: 5px 0px;">
	                                <input type="hidden" name="birth_certi_path" value="<?php echo (empty($student_data[0]['rm_child_birth_certi_photo'])?"":$student_data[0]['rm_child_birth_certi_photo']) ?>" style="border:none;font-size: 10px;width: 100%;" readonly/>
	                                <?php 
	                                    if (!empty($student_data)):
	                                ?>
	                                    <p style="margin-top: 20px;"> PDF FILE : 
	                                		<a href="<?php echo base_url('public/uploads/product/'.$student_data[0]['rm_child_birth_certi_photo']) ?>" target="_blank">
	                                			<?php echo $student_data[0]['rm_child_birth_certi_photo'] ?>
	                                		</a>
	                                	</p>
										<!-- <img src="<?php echo base_url('public/uploads/product/'); ?><?php echo "/".$student_data[0]['rm_child_birth_certi_photo'] ?>" id="birth_target" class="img-responsive" onclick="open_model_img(this,'BIRTH CERTIFICATE')"/> -->
	                                <?php 
	                                	endif;
	                                ?>
	                            </div>
	                            <div class="col-md-2" >
	                                <label class="control-label">Aadhar Card ( pdf )</label>
	                                <input type="file" class="form-control" id="rm_child_aadhar_card_photo" name="rm_child_aadhar_card_photo" title="Aadhar Card" style="border: none;padding: 5px 0px;">
	                                <input type="hidden" name="aadhar_certi_path" value="<?php echo (empty($student_data[0]['rm_child_aadhar_card_photo'])?"":$student_data[0]['rm_child_aadhar_card_photo']) ?>" style="border:none;font-size: 10px;width: 100%;" readonly/>
	                                
	                                <?php 
	                                   	if (!empty($student_data)):
	                                ?>
	                                	<p style="margin-top: 20px;"> PDF FILE : 
	                                		<a href="<?php echo base_url('public/uploads/product/'.$student_data[0]['rm_child_aadhar_card_photo']) ?>" target="_blank">
	                                			<?php echo $student_data[0]['rm_child_aadhar_card_photo'] ?>
	                                		</a>
	                                	</p>
	                                <?php 
	                                   	endif;
	                                ?>
	                            </div>
	                        </div>
	                        <br>
	                        <br>
	                        <div class="row">
	                        	<div class="col-md-2 col-md-offset-9">
	                        		<button class="btn" type="button" style="width: 100%;background-color: #008d4c;color:#fff;" onclick="nextStep()">NEXT</button>
	                        	</div>
	                        </div>
	                        <br>
	                        <br>
					</div>
					<div class="tab-pane" id="a2a" style="margin-top: 30px;">
		          			<div class="form-group">
	                            <label class="col-md-2 control-label">Father's Name</label>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_father_last_name" id="rm_child_father_last_name" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_father_last_name'])?>" placeholder="LAST NAME" title="Third"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_father_name'])?>" id="father_name" placeholder="FIRST" title="First"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_father_middle_name" id="rm_child_father_middle_name" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_father_middle_name'])?>" placeholder="FATHER NAME" title="Second"/>
	                            </div>
	                            
	                        </div>
	                        <br/>
	                        <div class="form-group">
	                            <label class="col-md-2 control-label">Father's Details</label>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_father_age" id="rm_child_father_age" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_father_age'])?>" placeholder="AGE" title="Age"/>
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_father_qualification" id="rm_child_father_qualification" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_father_qualification'])?>" placeholder="QUALIFICATION" title="Qualification"/>
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_father_occupation" id="rm_child_father_occupation" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_father_occupation'])?>" placeholder="OCCUPATION" title="Occupation"/>
	                            </div>
	                           <!--  <div class="col-md-3 col-md-offset-2">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_father_designation" id="rm_child_father_designation" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_father_designation'])?>" placeholder="DESIGNATION" title="Designation"/>
	                            </div> -->
	                        </div>
                        	<br/>

	                        <div class="form-group">
	                            <label class="col-md-2 control-label">Mother's Details</label>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_mother_full_name" id="rm_child_mother_full_name" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_mother_full_name'])?>" placeholder="FULL NAME" title="Full Name"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_mother_qualification" id="rm_child_mother_qualification" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_mother_qualification'])?>" placeholder="QUALIFICATION" title="Qualification"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_mother_occupation" id="rm_child_mother_occupation" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_mother_occupation'])?>" placeholder="OCCUPATION" title="Occupation"/>
	                            </div>
	                        </div>
                        	<br>
	                        <div class="form-group">
	                            <label class="col-md-2 control-label">Office Address</label>
	                            <div class="col-md-3">
	                                <textarea  class="form-control cust_ip_border" name="rm_child_family_office_add" id="rm_child_family_office_add" placeholder="HOUSE No., STREET NAME" title="House no.,Street Name" row="3" maxlength="165"><?php echo (empty($student_data)?'':$student_data[0]['rm_child_family_office_add'])?></textarea>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_family_office_add_city" id="rm_child_family_office_add_city" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_family_office_add_city'])?>" placeholder="TOWN / CITY" title="Town/City"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_family_office_add_pin_code" id="rm_child_family_office_add_pin_code" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_family_office_add_pin_code'])?>" placeholder="PINCODE" title="Pincode"/>
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_family_office_add_state" id="rm_child_family_office_add_state" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_family_office_add_state'])?>" placeholder="STATE" title="State"/>
	                            </div>
	                        </div>

	                        <br>

	                        <div class="form-group">
	                            <label class="col-md-2 control-label">Contact Details</label>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_family_phone_no" id="rm_child_family_phone_no" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_family_phone_no'])?>" placeholder="PHONE" title="Phone"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_family_mob_no" id="rm_child_family_mob_no" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_family_mob_no'])?>" placeholder="MOB NO" title="Mob No." maxlength="10" />
	                            </div>

	                            <!-- <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_family_fax_no" id="rm_child_family_fax_no" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_family_fax_no'])?>" placeholder="FAX NO" title="Fax No."/>
	                            </div> -->
	                            
	                        </div>
	                        <br>

	                        <div class="form-group">
	                            <label class="col-md-2 control-label">Other Details</label>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_family_email_id" id="rm_child_family_email_id" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_family_email_id'])?>" placeholder="EMAIL ID" title="Email"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_family_monthly_income" id="rm_child_family_monthly_income" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_family_monthly_income'])?>" placeholder="MONTHLY INCOME" title="monthly income"/>
	                            </div>

	                            
	                          
	                        </div>
                        	<br>
                          	<h4 style="color:white;text-align:center;font-size:18px;color:#C9766E;padding:15px;font-weight:bold;">Information about child's siblings</h4>
                         	<p style="text-align: center;font-weight: bold;color: red">(Note : to be filled only if child is studying in AL-BARKAAT Malik Muhammad Islam English School. A maximum of two siblings can be added.)</p>

	                        <div class="col-sm-10 col-sm-offset-1">
	                            <table class="table table-bordered" >
	                                <tr>
	                                    <th width="15%" style="color: #000;">School</th>
	                                    <th width="9%" style="color: #000;">GR NO.</th>
	                                    <th width="40%" style="color: #000;">Name</th>
	                                    <th width="9%" style="color: #000;">Std</th>
	                                    <th width="9%" style="color: #000;">Div</th>
	                                    <th width="10%" style="color: #000;">Roll No.</th>
	                                    <th style="width:8%;">Action</th>
	                                </tr>
	                                <tr id="cs_row_cnt">
	                                	<td>
	                                        <input type="text" class="form-control" id="st_school" aria-describedby="inputSuccess2Status" style="text-transform: uppercase;" placeholder="AL-BARKAAT" value="AL-BARKAAT" readonly>
	                                    </td>
	                                    <td>
	                                        <input type="text" class="form-control" id="st_gr_no"  aria-describedby="inputSuccess2Status" style="text-transform: uppercase;">
	                                    </td>
	                                    <td>
	                                        <input type="text" class="form-control" id="st_name"  aria-describedby="inputSuccess2Status" style="text-transform: uppercase;">
	                                    </td>
	                                    <td>
	                                        <input type="text" class="form-control" id="st_std"  aria-describedby="inputSuccess2Status" style="text-transform: uppercase;" >
	                                    </td>
	                                    <td>
	                                        <input type="text" class="form-control" id="st_div" aria-describedby="inputSuccess2Status" style="text-transform: uppercase;">
	                                    </td>
	                                    <td>
	                                        <input type="text" class="form-control" id="st_roll_no"  aria-describedby="inputSuccess2Status" style="text-transform: uppercase;" >
	                                    </td>

	                                    <td style="text-align: center;">
	                                        <button type="button" class="btn btn-success" style="padding-top: 5px;padding-bottom: 5px;" onClick="add_siblings_row();"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;Add</button>  
	                                    </td>
	                                </tr>
	                            </table>
	                        </div>

	                        <br>
	                        <?php
	                            $cs_row_cnt = 0; 
	                        ?>
	                        <div class="col-sm-10 col-sm-offset-1">
	                            <table class="table table-bordered" id="siblings_wrapper">
	                                <tr id="rowid_<?php echo $cs_row_cnt;?>">
	                                    <th width="15%" style="color: #000;">SCHOOL</th>
	                                    <th width="9%" style="color: #000;">GR NO.</th>
	                                    <th width="40%" style="color: #000;">Name</th>
	                                    <th width="9%" style="color: #000;">Std</th>
	                                    <th width="9%" style="color: #000;">Div</th>
	                                    <th width="10%" style="color: #000;">Roll No.</th>
	                                    <th style="width:8%;">Action</th>
	                                </tr>
	                            <?php
	                                $cs_row_cnt++; 
	                            ?>

	                            	<?php                                        
                                        $sibling_cnt = 1;
                                        foreach ($st as $key => $value):
                                    ?>

                                    <tr id="rowid_<?php echo $sibling_cnt;?>">
                                        <td>
                                            <input type="text" name="sbltr_school[]" class="form-control"  readonly value="<?php echo (empty($value['sbltr_school'])?"":$value['sbltr_school']) ?>" />
                                        </td>

                                        <td>
                                            <input type="text" name="sbltr_gr_no[]" class="form-control"  readonly value="<?php echo (empty($value['sbltr_gr_no'])?"":$value['sbltr_gr_no']) ?>" />
                                        </td>
                                        <td>
                                            <input type="text" name="sbltr_sbl_name[]" class="form-control"  readonly value="<?php echo (empty($value['sbltr_sbl_name'])?"":$value['sbltr_sbl_name']) ?>" />
                                        </td>
                                        <td>
                                            <input type="text" name="sbltr_sbl_std[]" class="form-control"  readonly value="<?php echo (empty($value['sbltr_sbl_std'])?"":$value['sbltr_sbl_std']) ?>" />
                                        </td>
                                        <td>
                                            <input type="text" name="sbltr_sbl_div[]" class="form-control"  readonly value="<?php echo (empty($value['sbltr_sbl_div'])?"":$value['sbltr_sbl_div']) ?>" />
                                        </td>
                                        <td>
                                            <input type="text" name="sbltr_sbl_roll_no[]" class="form-control"  readonly value="<?php echo (empty($value['sbltr_sbl_roll_no'])?"":$value['sbltr_sbl_roll_no']) ?>" />
                                        </td>
                                        <td style="text-align:right;">
                                            <button type="button" class="btn btn-danger" onClick="remove_siblings_row(<?php echo $sibling_cnt; ?>)">Remove</button>
                                        </td>
                                    </tr>
                                    <?php
                                        $sibling_cnt++;
                                        endforeach;
                                    ?>
	                            </table>
	                            <hr style="border-color: #111;">
	                        </div>
                        	<br>
                         	<!-- guardian's details starts -->
                        	<h4 style="color:white;text-align:center;font-size:18px;color:#C9766E;padding:15px;font-weight:bold;">STUDENT'S GUARDIANS DETAILS (If Student is not residing with parents)</h4>

	                        <div class="form-group">
	                            <label class="col-md-2 control-label">Name of Guardian in Mumbai</label>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_fname" id="rm_child_guardian_fname" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_fname'])?>" placeholder="FIRST NAME" title="First Name"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_mname" id="rm_child_guardian_mname" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_mname'])?>" placeholder="MIDDLE NAME" title="Middle Name"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_lname" id="rm_child_guardian_lname" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_lname'])?>" placeholder="LAST NAME" title="Last Name"/>
	                            </div>
	                            
	                        </div>

	                        <br>
	                        <div class="form-group">
	                            <label class="col-md-2 control-label">Relationship with Student</label>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_relationship" id="rm_child_guardian_relationship" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_relationship'])?>" placeholder="RELATIONSHIP" title="Relationship"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_age" id="rm_child_guardian_age" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_age'])?>" placeholder="AGE" title="Age"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_occupation" id="rm_child_guardian_occupation" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_occupation'])?>" placeholder="OCCUPATION" title="occupation"/>
	                            </div>

	                             <div class="col-md-3 col-md-offset-2">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_designation" id="rm_child_guardian_designation" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_designation'])?>" placeholder="DESIGNATION" title="Designation"/>
	                            </div>
	                            
	                        </div>
	                        <br>
	                        <div class="form-group">
	                            <label class="col-md-2 control-label">Office Address</label>
	                            <div class="col-md-3">
	                                <textarea  class="form-control cust_ip_border" name="rm_child_guardian_office_add" id="rm_child_guardian_office_add" placeholder="HOUSE No., STREET NAME" title="House no.,Street Name" row="3" maxlength="165"><?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_office_add'])?></textarea>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_office_add_city" id="rm_child_guardian_office_add_city" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_office_add_city'])?>" placeholder="TOWN / CITY" title="Town/City"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_office_add_pin_code" id="rm_child_guardian_office_add_pin_code" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_office_add_pin_code'])?>" placeholder="PINCODE" title="Pincode"/>
	                            </div>
	                            <div class="col-md-3 ">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_office_add_state" id="rm_child_guardian_office_add_state" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_office_add_state'])?>" placeholder="STATE" title="State"/>
	                            </div>
	                        </div>

                        	<br>

	                        <div class="form-group">
	                            <label class="col-md-2 control-label">Contact Details</label>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_phone_no" id="rm_child_guardian_phone_no" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_phone_no'])?>" placeholder="PHONE" title="Phone"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_mobile_no" id="rm_child_guardian_mobile_no" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_mobile_no'])?>" placeholder="MOB NO" title="Mob No."/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_fax_no" id="rm_child_guardian_fax_no" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_fax_no'])?>" placeholder="FAX NO" title="Fax No."/>
	                            </div>
	                            
	                        </div>
	                        <br>

	                        <div class="form-group">
	                            <label class="col-md-2 control-label">Other Details</label>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_email_id" id="rm_child_guardian_email_id" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_email_id'])?>" placeholder="EMAIL ID" title="Email"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_monthly_income" id="rm_child_guardian_monthly_income" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_monthly_income'])?>" placeholder="MONTHLY INCOME NO" title="monthly income"/>
	                            </div>

	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_guardian_mother_tongue" id="rm_child_guardian_mother_tongue" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_guardian_mother_tongue'])?>" placeholder="MOTHER TONGUE" title="Mother Tongue"/>
	                            </div>
	                            
	                        </div>
	                        <br/>
	                        <br/>       

	                        <div class="row">
								<div class="col-md-2 col-md-offset-4 col-xs-6">
									<button type="button" class="btn btn-success" id="sbt_btn" onClick="<?php echo (empty($student_data)?"update_student_data(0)":"update_student_data(".$student_data[0]['rm_id'].")")?>" style="width:100%;">SAVE & PAY</button>
								</div>
								<div class="col-md-2 col-xs-6">
									<a href="#" type="button" class="btn btn-danger" style="width:100%;">Cancel</a>
								</div>
								<!-- <div class="col-md-2 col-xs-12">
									<button type="button" class="btn btn-primary" id="sbt_btn" onClick="<?php echo (empty($student_data)?"preview(0)":"preview(".$student_data[0]['rm_id'].")")?>" style="background-color: #ff9900;width:100%;">PREVIEW</button>
								</div> -->
								<!-- <div class="col-sm-2 col-sm-offset-1"><button class="btn btn-primary" onClick="print_appl(<?php echo $student_data[0]['rm_id']?>)">Download PDF</button></div> -->
							</div>
							
							<br>
							<br>
							<br>
					</div>
				</div>
					</form>
  			</div>

	  	
  	</div>
<?php
	$this->load->view('templates/temp_footer');
?>

<?php 
echo "<script>";
echo "cs_frow_cnt = $sibling_cnt;";
echo "</script>";
 ?>