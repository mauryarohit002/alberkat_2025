<?php
$this->load->view('admin/templates/header');
$role = $this->session->userdata("user_role_id");
if(isset($_GET['search_field']) || isset($_GET['search_keyword']) || isset($_GET['order']))
{
    $search_field      = $_GET['search_field'];
    $search_keyword    = $_GET['search_keyword'];
    $order             = $_GET['order'];



     $start_date        = $_GET['start_date'];
    $end_date          = $_GET['end_date'];
}
else
{
    $search_field      = "";
    $search_keyword    = "";
    $order             = ""; 
    $start_date        = "";
    $end_date          = "";    
}

?>
    <script>
        var link = "app_fnp";
        var sub_link = "app_fnp";
    </script>
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="padding-top:0px;background:#fff;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Application Master (PROVISIONAL SELECTION)
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">
                Application Master (PROVISIONAL SELECTION)</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
        <br>
            <form class="form-horizontal" id="report_search_form">
				<div class="form-group">
                    <div class="col-sm-1 col-sm-offset-1">
                        <!-- <label for="search_keyword" class="control-label">Search Keyword</label> -->
                        <input type="text" class="form-control cust_bt_border dash_date"  name="start_date" id="search_keyword" value="<?php echo $start_date?>" autocomplete="off" placeholder="Start Date"> 
                    </div>

                    <div class="col-sm-1">
                        <!-- <label for="search_keyword" class="control-label">Search Keyword</label> -->
                        <input type="text" class="form-control cust_bt_border dash_date"  name="end_date" id="search_keyword" value="<?php echo $end_date?>" autocomplete="off" placeholder="End Date"> 
                    </div>
                    
					<div class="col-sm-2">
						<!-- <label for="search_field" class="control-label">Search Field</label> -->
						<select name="search_field" class="form-control cust_bt_border" id="search_field" onchange="clear_search_keyword();">
								<?php
									foreach ($search_data as $key => $value):
										if($search_field != "" && $search_field == $key)
											echo "<option value='$key' selected>$value</option>";
										else
											echo "<option value='$key'>$value</option>";
									endforeach;
								?>
						</select>
					</div>
					<div class="col-sm-2">
						<!-- <label for="search_keyword" class="control-label">Search Keyword</label> -->
						<input type="text" class="form-control cust_bt_border"  name="search_keyword" id="search_keyword" value="<?php echo $search_keyword?>" autocomplete="off" placeholder="Search Value"> 
					</div>
					<div class="col-sm-2">
						<!-- <label for="order" class="control-label">Order By</label> -->
						<select name="order" class="form-control cust_bt_border" id="order">
							<option value="desc" <?php echo ($order =='desc')?'selected':''?>>order by DESC</option>
							<option value="asc" <?php echo ($order =='asc')?'selected':''?>>order by ASC</option>
						</select>
                    </div>
                    <div class="col-sm-2">
						<!-- <label for="total">Count</label> -->
						<input type="text" class="form-control cust_bt_border" value="COUNT : <?php echo !empty($data_cnt)?$data_cnt:''?>" autocomplete="off" readonly> 
					</div>
					<div class="col-sm-1">
                    
					<!-- <label for="action" class="control-label">`</label> -->
						<button type="submit" class="btn btn-primary cust_search_btn">Search</button>
					</div>
					
				</div>
            </form>
            <div class="alert_msg"></div>
            <div class="row">
                <div class="col-md-12">     
                    <div class="box">
                        <div class="box-body">
                        <?php
							if (!empty($reg_data)):
						?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>App No</th>
                                        <th>Std</th>
                                        <th>Date of <br>Submission</th>
                                        <th>Income</th>
                                        <th>Child Details</th>
                                        <th>Father Details</th>
                                        <th>Mother Details</th>
                                        <th>Guardian Details</th>
                                        <th>View / print</th>     
                                        <th>Status</th>
                                        <th>Description</th>   
                                        <th>Save/<br/>SMS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cnt = 1;
                                    foreach ($reg_data as $key => $value) :
                                    ?>
                                        <tr class="tr_bottom">
                                            <form id="app_status_approve_<?php echo $cnt ?>">     
                                                <td><?php echo $value['rm_app_no']; ?></td>
                                                <td><?php echo $value['rm_child_class']; ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($value['rm_reg_date'])); ?></td>
                                                <td><?php echo $value['rm_child_family_monthly_income'] ?></td>
                                                <td>
                                                    <textarea class="form-control dash_cust_ip" cols="17" rows="5" readonly><?php echo "NAME : " . $value['rm_child_name'] . "\n" . "DOB : " . date('d-m-Y', strtotime($value['rm_child_birth_date'])). "\n" . "MOB : " . $value['rm_parent_mob_no'] ?>
                                                </textarea>    
                                            
                                                </td>
                                                <td>
                                                    <textarea class="form-control dash_cust_ip" cols="17" rows="5" readonly><?php echo "NAME : " . $value['rm_child_father_name'] . " " . $value['rm_child_father_last_name'] . "\n" . "QUALI : " . $value['rm_child_father_qualification'] . "\n" . "OCCU : " . $value['rm_child_father_occupation'] ?>
                                                    </textarea>    
                                                </td>
                                                <td>
                                                    <textarea class="form-control dash_cust_ip" cols="17" rows="5" readonly><?php echo "NAME : " . $value['rm_child_mother_name'] . " " . $value['rm_child_father_last_name'] . "\n" . "QUALI : " . $value['rm_child_mother_qualification'] . "\n" . "OCCU : " . $value['rm_child_mother_occupation'] ?>
                                                </textarea>   
                                                </td>
                                                <td>
                                                <textarea class="form-control dash_cust_ip" cols="17" rows="5" readonly><?php echo "NAME : " . $value['rm_child_guardian_fname'] . " " . $value['rm_child_guardian_lname'] . "\n" . "OCCU : " . $value['rm_child_guardian_occupation'] ?>
                                                    </textarea>   
                                                </td>
                                                <td align="center">
                                                    <button type="button" class="glyphicon glyphicon-eye-open dash_cust_btn_view" onClick="preview_student(<?php echo $value['rm_id'] ?>);"></button><br>
                                                    <button type="button" class="glyphicon glyphicon-print dash_cust_btn_sp" style="margin-bottom:10px;" onClick="print_student(<?php echo $value['rm_id'] ?>);"></button><br>
                                                    <!-- <button class="glyphicon glyphicon-print dash_cust_btn_tp" onClick="print_teach_form(<?php echo $value['rm_id'] ?>);"></button> -->
                                                </td>
                                                <td>
                                                    <select class="form-control dash_cust_drop_down" name="rm_app_status" onchange="add_th_td(this.value,<?php echo $cnt ?>)">        
                                                        <?php foreach ($app_status as $key1 => $value1) : ?>    
                                                            <option value="<?php echo $key1 ?>" <?php echo ($value['rm_app_status'] == $key1) ? 'selected' : '' ?>><?php echo $value1 ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <br>
                                                    <a href="<?php echo base_url('admin/cmaster/get_all_application_sms?id='.$value['rm_id'])?>" style="text-decoration: underline;color: #c9766e" target="_blank">..LINK - SMS REPORT</a>
                                                     <br>
                                                    <a href="<?php echo base_url('admin/cmaster/get_all_uploaded_docs?id='.$value['rm_id'])?>" style="text-decoration: underline;color: #222d32" target="_blank">..LINK - DOCUMENTS</a>
                                                </td>
                                                <td>
                                                    <input type='text' name='rm_desc_date' class='form-control dash_cust_ip dash_date' placeholder='DATE' style='border-bottom:1px solid #ccc;' value="<?php echo ($value['rm_desc_date'] =='0000-00-00')?'':date('d-m-Y',strtotime($value['rm_desc_date'])) ?>" ><br/>
                                                    <textarea type='text' class='form-control dash_cust_ip' name='rm_desc' placeholder='DESCRIPTION'><?php echo $value['rm_desc']?></textarea></td>
                                                <td>
                                                    <button type="button" class="btn btn-success dash_cust_save" id="save_btn" onclick="app_status_update(<?php echo $value['rm_id']?>,<?php echo $cnt?>)">save</button>    
                                                </td> 
                                            </form> 
                                        </tr>
                                    <?php
                                    $cnt++;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        <?php 
                                echo $this->pagination->create_links();
                        else:
                            echo "<h1 class='text-center'>No result found!</h1>";
                        endif;
                        ?>    
                        </div>
                    </div>
                </div>
            </div>
        </section>
       </div>
       
<?php
$this->load->view('admin/templates/footer');
?>