<?php
$this->load->view('admin/templates/header');
$role = $this->session->userdata("user_role_id");
if(isset($_GET['search_field']) || isset($_GET['search_keyword']) || isset($_GET['order']))
{
    $search_field      = $_GET['search_field'];

    // $search_keyword    = $_GET['search_keyword'];
    // $order             = $_GET['order'];
    // $start_date        = $_GET['start_date'];
    // $end_date          = $_GET['end_date'];
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
        var link = "app_all";
        var sub_link = "app_all";
    </script>
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="padding-top:0px;background:#fff;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Student Report
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">
                Student Report</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <br>
            <form class="form-horizontal" id="report_search_form">
                <div class="form-group">
                    <div class="col-sm-2" style="text-align: right;">
                        <label for="search_keyword" class="control-label" >Application Status</label>
                    </div>
                    <div class="col-sm-2">
                        <select name="search_field" class="form-control cust_bt_border" id="search_field">
                                <?php
                                    foreach ($app_status as $key => $value):
                                        if($search_field != "" && $search_field == $key)
                                            echo "<option value='$key' selected>$value</option>";
                                        else
                                            echo "<option value='$key'>$value</option>";
                                    endforeach;
                                ?>
                        </select>
                    </div>
                   
                    <div class="col-sm-1">
                        <!-- <label for="action" class="control-label">`</label> -->
                        <button type="submit" class="btn btn-primary cust_search_btn">Search</button>
                    </div>
                    <div class="col-sm-1">
                        <?php 
                            $url = $_SERVER['QUERY_STRING'];
                        ?>   
                        <a href="<?php echo base_url('admin/cmaster/app_progress_print?'.$url)?>" class="btn btn-primary" style="width:100%;" target="_blank">Export</a>
                    </div>
                </div>
            </form>
            <div class="alert_msg"></div>
            <div class="row">
                <div class="col-md-12">     
                    <div class="box">
                        <div class="box-body">
                        <?php
							if (!empty($app_data)):
						?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>App No</th>
                                        <th>Std</th>
                                        <th>Date of <br>Submission</th>
                                        <th>Child Details</th>
                                        <th>Father Details</th>
                                        <th>Mother Details</th>
                                        <th>Application Progress</th>
                                        <th>Status</th>
                                        <th>GR NO</th>
                                        <th>Sibling</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cnt = 1;
                                    // echo "<pre>";print_r($app_data);exit();

                                    foreach ($app_data as $key => $value) :
                                    ?>
                                        <tr class="tr_bottom">
                                            <form id="app_status_approve_<?php echo $cnt ?>">     
                                                <td><?php echo $value['data']['rm_app_no']; ?></td>
                                                <td><?php echo $value['data']['rm_child_class']; ?></td>

                                                <td><?php echo date('d-m-Y', strtotime($value['data']['rm_reg_date'])); ?></td>
                                                <td>
                                                    <textarea class="form-control dash_cust_ip" cols="17" rows="5" readonly><?php echo "NAME : " . $value['data']['rm_child_name'] . "\n" . "DOB : " . date('d-m-Y', strtotime($value['data']['rm_child_birth_date'])). "\n" . "MOB : " . $value['data']['rm_parent_mob_no'] ?>
                                                    </textarea>    
                                                </td>
                                                <td>
                                                    <textarea class="form-control dash_cust_ip" cols="17" rows="5" readonly><?php echo "NAME : " . $value['data']['rm_child_father_name'] . " " . $value['data']['rm_child_father_last_name'] . "\n" . "QUALI : " . $value['data']['rm_child_father_qualification'] . "\n" . "OCCU : " . $value['data']['rm_child_father_occupation'] ?>
                                                    </textarea>    
                                                </td>

                                                <td>
                                                    <textarea class="form-control dash_cust_ip" cols="17" rows="5" readonly><?php echo "NAME : " . $value['data']['rm_child_mother_name'] . " " . $value['data']['rm_child_father_last_name'] . "\n" . "QUALI : " . $value['data']['rm_child_mother_qualification'] . "\n" . "OCCU : " . $value['data']['rm_child_mother_occupation'] ?>
                                                    </textarea>   
                                                </td>
                                                
                                                <td>
                                                    <table class="table">
                                                        <tr>
                                                            <th>date</th>
                                                            <th>status</th>
                                                        </tr>
                                                        <?php 
                                                            foreach ($value['data']['app_progress'] as $key2 => $value2): 
                                                        ?>

                                                        <tr>
                                                            <td><?php echo date('d-m-Y',strtotime($value2['rt_status_date']))?></td>
                                                            <td><?php echo $app_status[$value2['rt_rm_status']] ?></td>
                                                        </tr>

                                                        <?php 
                                                            endforeach;
                                                        ?>
                                                    </table>
                                                </td>

                                                <td>
                                                    <select class="form-control dash_cust_drop_down" name="rm_app_status" onchange="add_th_td(this.value,<?php echo $cnt ?>)">        
                                                        <?php foreach ($app_status as $key1 => $value1) : ?>    
                                                            <option value="<?php echo $key1 ?>" <?php echo ($value['data']['rm_app_status'] == $key1) ? 'selected' : '' ?>><?php echo $value1 ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <?php echo $value['data']['rm_child_gr_no'] ?>
                                                </td>

                                                <td>
                                                    <?php 
                                                        if ($value['data']['rm_sibling_flag'] == 0) {
                                                            echo "NO";
                                                        }
                                                        else
                                                        {
                                                            echo "YES";
                                                        }
                                                    ?>
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