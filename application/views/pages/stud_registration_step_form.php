<?php
    $this->load->view('templates/temp_header');
?>
  	<div class="container-fluid">
  		<div class="container">

<form class="form-horizontal" id="order_form">
	          				<br>
		          			<div class="form-group">
	                            <label for="inputEmail3" class="col-md-2 control-label">Date</label>
	                            <div class="col-md-3 col-xs-12">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_reg_date" id="rm_reg_date" value="<?php echo (empty($student_data)?date("d-m-Y"):date('d-m-Y',strtotime($student_data[0]['rm_reg_date'])))?>" readonly/>
	                            </div>
	                            <label for="inputEmail3" class="col-md-2 col-md-offset-2 control-label">Aadhar Card No.</label>
	                            <div class="col-md-2">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_aadhar_no" id="rm_child_aadhar_no" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_aadhar_no'])?>" placeholder="AADHAR NO" title="Aadhar No."/>
	                            </div>
	                        </div>
                       		<br>
                        	<div class="form-group">
                            	<label for="inputEmail3" class="col-md-2 control-label">NAME</label>
                            	<div class="col-md-3 col-xs-12">
                            		<input type="text" class="form-control cust_ip_border" name="rm_child_surname" id="rm_child_surname" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_surname'])?>" placeholder="SURNAME" title="Surname"/>
                            	</div>
	                            <div class="col-md-3 col-xs-12">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_name" id="rm_child_name" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_name'])?>" placeholder="CHILD NAME" title="Child Name"/>
	                            </div>
	                            <div class="col-md-3 col-xs-12">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_surname" id="rm_child_surname" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_surname'])?>" placeholder="SURNAME" title="Father Name"/>
	                            </div>
	                            <div class="col-md-3 col-md-offset-2 col-xs-12">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_surname" id="rm_child_surname" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_surname'])?>" placeholder="MOTHER NAME" title="Mother Name"/>
	                            </div>
                        	</div>
                        	<br>
	                        <div class="form-group">
	                        	<label for="inputEmail3" class="col-md-2 control-label">Gender</label>
	                        	<div class="col-md-2 col-xs-12">
	                            	<label class="radio-inline">
	                                    <input type="radio" name="rm_child_gender" class="gender_class" value="M" <?php echo (($student_data[0]['rm_child_gender'] == "M")?"checked":"") ?>>Male
	                                </label>
	                                <label class="radio-inline">
	                                    <input type="radio" name="rm_child_gender" class="gender_class" value="F" <?php echo (($student_data[0]['rm_child_gender'] == "F")?"checked":"") ?>>Female
	                                </label>
	                            </div>
	                            <label for="inputEmail3" class="col-md-1 control-label">Date of Birth</label>
	                        	<div class="col-md-3 col-xs-12">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_birth_date" id="rm_child_birth_date" value="<?php echo (empty($student_data)?'':date('d-m-Y',strtotime($student_data[0]['rm_child_birth_date'])))?>" placeholder="DATE OF BITRH" title="Date of Bitrh" readonly/>
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
	                        	<label for="inputEmail3" class="col-md-2 control-label">Permanent Address(max 200)</label>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_per_add_house_no" id="rm_child_per_add_house_no" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_per_add_house_no'])?>" placeholder="HOUSE No., STREET NAME" title="House no.,Street Name"/>
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_per_add_town" id="rm_child_per_add_town" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_per_add_town'])?>" placeholder="TOWN / CITY" title="Town ? City"/>
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_per_add_pin_code" id="rm_child_per_add_pin_code" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_per_add_pin_code'])?>" placeholder="PINCODE" title="Pincode"/>
	                            </div>
	                            <div class="col-md-3 col-md-offset-2">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_per_add_state" id="rm_child_per_add_state" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_per_add_state'])?>" placeholder="STATE" title="state"/>
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_per_add_municipality_ward" id="rm_child_per_add_municipality_ward" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_per_add_municipality_ward'])?>" placeholder="MUNICIPALITY WARD (Eg. Ward L)" title="Municipality ward (Eg. Ward L)"/>
	                            </div>
	                        </div>
                        	<br>
	                        <div class="form-group">
	                        	<div class="col-md-2">
	                                <label class="control-label">Temporary Address</label>
	                                <b>Same as above</b>&nbsp;<input type="checkbox" class="add_copy" name="rm_child_tmp_add_same_as_per">
	                            </div>
	                            <div class="col-md-3">
	                            	<input type="text" class="form-control cust_ip_border" name="rm_child_temp_add_house_no" id="rm_child_temp_add_house_no" value="<?php echo (empty($student_data)?'':$student_data[0]['rm_child_temp_add_house_no'])?>" placeholder="HOUSE No., STREET NAME" title="House no.,Street Name"/>
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
	                                    <option value="yes" <?php echo $student_data[0]['rm_child_pre_school_attend'] == 'yes'?"selected":"" ?>>Yes</option>
	                                    <option value="no"  <?php echo $student_data[0]['rm_child_pre_school_attend'] == 'no'?"selected":"" ?>>No</option>
	                                </select>
	                            </div>
	                            <div class="col-md-3" id="pre_school_ip">
	                                <?php if  (empty($student_data)?'':$student_data[0]['rm_child_lng_spkn_at_home_3']== 'yes'):?>
	                                    <input type="text" id="rm_child_pre_school_name" name="rm_child_pre_school_name" value="<?php echo (empty($student_data[0]['rm_child_pre_school_name'])?"":$student_data[0]['rm_child_pre_school_name']) ?>" class="form-control">
	                                <?php endif; ?>    
	                            </div>
	                        </div>
	                        <br>
	                        <br>
	                        <div class="form-group">
	                            <div class="col-sm-6 col-sm-offset-3">
	                                <b><i>Photo size should be 300 x 300 pixels and less than 500KB <br/> (with white background)</i></b>
	                            </div>
	                        </div>
	                        <div class="form-group" >
	                            <div class="col-md-2">
	                                <label class="control-label">Please Attach Latest Photograph of</label>
	                            </div>
	                            <div class="col-md-3" >
	                                <label class="control-label">Child Photo</label>
	                                    <input id="rm_child_photo" name="rm_child_photo" type="file" class="form-control"  data-toggle="tooltip" title="Child" >
	                                    <input type="text" name="rm_child_photo_path" value="<?php echo (empty($student_data[0]['rm_child_photo'])?"":$student_data[0]['rm_child_photo']) ?>" readonly/>
	                                    <img src="<?php echo base_url('public/uploads/product/'); ?><?php echo "/".$student_data[0]['rm_child_photo'] ?>" style="width: 200px;height: 200px;"/>
	                            </div>
	                            <div class="col-md-1"></div>
	                            <div class="col-md-3" >
	                                	<label class="control-label">Family Photo</label>
	                                    <input id="rm_child_family_photo" name="rm_child_family_photo" type="file" class="form-control" data-toggle="tooltip" title="Mother">
	                                    <input type="text" name="rm_child_family_photo_path" value="<?php echo (empty($student_data[0]['rm_child_family_photo'])?"":$student_data[0]['rm_child_family_photo']) ?>" readonly/>
	                                    <img src="<?php echo base_url('public/uploads/product/'); ?><?php echo "/".$student_data[0]['rm_child_family_photo'] ?>" style="width: 200px;height: 200px;"/>
	                            </div>
	                        </div>
	                        <br>
	                        <div class="form-group">
	                            <div class="col-md-3 col-sm-offset-2">
	                                <label>Please Attach child's Birth Certificate</label>
	                                <b><i>(size should be less than 500KB)</i></b><br><br>
	                                <label class="control-label">Birth Certificate Photo</label>  
	                                <input id="rm_child_birth_certi_photo" name="rm_child_birth_certi_photo" type="file" class="form-control" data-toggle="tooltip" title="Birth Certificate">
	                                <input type="text" name="birth_certi_path" value="<?php echo (empty($student_data[0]['rm_child_birth_certi_photo'])?"":$student_data[0]['rm_child_birth_certi_photo']) ?>" readonly/>
	                                <img src="<?php echo base_url('public/uploads/product/'); ?><?php echo "/".$student_data[0]['rm_child_birth_certi_photo'] ?>" style="width: 200px;height: 200px;"/>
	                            </div>
	                            <div class="col-sm-1"></div>
	                            <div class="col-md-3" >
	                             	<label>Please Attach child's Aadhar Card</label>
	                                <b><i>(size should be less than 500KB)</i></b><br> <br>    
	                                <label class="control-label">Aadhar Card Photo</label>
	                                <input id="rm_child_aadhar_card_photo" name="rm_child_aadhar_card_photo" type="file" class="form-control" data-toggle="tooltip" title="Birth Certificate">
	                                <input type="text" name="aadhar_certi_path" value="<?php echo (empty($student_data[0]['rm_child_aadhar_card_photo'])?"":$student_data[0]['rm_child_aadhar_card_photo']) ?>" readonly/>
	                                <img src="<?php echo base_url('public/uploads/product/'); ?><?php echo "/".$student_data[0]['rm_child_aadhar_card_photo'] ?>" style="width: 200px;height: 200px;"/>
	                            </div>
	                        </div>
	                        <br>
                        	<div class="form-group">
                          		<div class="col-md-4 col-md-offset-4">
	                            	<br/>
	                            		<button type="button" class="btn btn_next" onclick="process_stud_reg_2()" >SUBMIT</button>
	                            	<br/>
                          		</div>
                        	</div>
	                        <br>
	                        <br>
                    	</form>
           	</div>
           	</div>
<?php
	$this->load->view('templates/temp_footer');
?>           	