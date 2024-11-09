<?php
//echo "<pre>";print_r($_SERVER);exit;
	$this->load->view('templates/header');

    if(isset($_GET['design'])){

        $dsg_no = $_GET['design'];
      
    }
    else{

        $dsg_no = "";

    }
?>
<script>
        var link = "report";
        var sub_link = "cust_design_bal_rp";
    </script>
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Customer Design Balance Summary Report
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Customer Design Balance Summary Report</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="alert_msg"></div>
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h4>Search Filter</h4>
                        </div>
                        <div class="box-body">
                            <form class="form-horizontal" id="report_search_form" >
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Design No</label>
                                    <div class="col-sm-2">
                                        <select name="design" class="form-control" id="design">
                                            <option value="0">All</option>
                                                <?php
                                                    foreach ($design as $key => $value):
                                                        if($dsg_no != "" && $dsg_no == $value['dsg_id'])
                                                            echo "<option value='".$value['dsg_id']."' selected>".$value['dsg_no']."</option>";
                                                        else
                                                            echo "<option value='".$value['dsg_id']."'>".$value['dsg_no']."</option>";
                                                    endforeach;
                                                ?>
                                        </select>
                                    </div>
                            
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary" style="width:100%;">Search</button>
                                    </div>
                                
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4>Search Result</h4>
                        </div>
                        <div class="box-body" style="overflow: auto;">
                        <?php if(!empty($order_trans_data)): ?>                        
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>  
                                        <th style="text-align:center">Design No</th>
                                        <th style="text-align:center">Order No</th>
                                        <th style="text-align:center">Cust Name</th>
                                        <th style="text-align:center">Size-12</th>
                                        <th style="text-align:center">Size-14</th>
                                        <th style="text-align:center">Size-16</th>
                                        <th style="text-align:center">Size-18</th>
                                        <th style="text-align:center">Size-20</th>
                                        <th style="text-align:center">Size-22</th>
                                        <th style="text-align:center">Size-24</th>
                                        <th style="text-align:center">Size-26</th>
                                        <th style="text-align:center">Size-28</th>
                                        <th style="text-align:center">Total Qty</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    <?php
                                        $count = isset($_GET['offset'])?$_GET['offset']:'0';
                                        $total_qty = 0;
                                        foreach ($order_trans_data as $key => $value):
                                        $total_qty = ((($value['ot_dsg_12']) - ($value['ot_dsg_12_issue_qty']))
                                                    + (($value['ot_dsg_14']) - ($value['ot_dsg_14_issue_qty']))
                                                    + (($value['ot_dsg_16']) - ($value['ot_dsg_16_issue_qty']))
                                                    + (($value['ot_dsg_18']) - ($value['ot_dsg_18_issue_qty']))
                                                    + (($value['ot_dsg_20']) - ($value['ot_dsg_20_issue_qty']))
                                                    + (($value['ot_dsg_22']) - ($value['ot_dsg_22_issue_qty']))
                                                    + (($value['ot_dsg_24']) - ($value['ot_dsg_24_issue_qty']))
                                                    + (($value['ot_dsg_26']) - ($value['ot_dsg_26_issue_qty']))
                                                    + (($value['ot_dsg_28']) - ($value['ot_dsg_28_issue_qty']))
                                                );    
                                    ?>
                                    <tr>
                                        <td><?php echo $value['dsg_no'];?></td>
                                        <td><?php echo $value['om_order_no'];?></td>
                                        <td><?php echo $value['acc_name'];?></td>
                                        <td><?php echo (($value['ot_dsg_12']) - ($value['ot_dsg_12_issue_qty']));?></td>
                                        
                                        <td><?php echo (($value['ot_dsg_14']) - ($value['ot_dsg_14_issue_qty']));?></td>
                                        <td><?php echo (($value['ot_dsg_16']) - ($value['ot_dsg_16_issue_qty']));?></td>
                                        <td><?php echo (($value['ot_dsg_18']) - ($value['ot_dsg_18_issue_qty']));?></td>
                                        <td><?php echo (($value['ot_dsg_20']) - ($value['ot_dsg_20_issue_qty']));?></td>
                                        <td><?php echo (($value['ot_dsg_22']) - ($value['ot_dsg_22_issue_qty']));?></td>
                                        <td><?php echo (($value['ot_dsg_24']) - ($value['ot_dsg_24_issue_qty']));?></td>
                                        <td><?php echo (($value['ot_dsg_26']) - ($value['ot_dsg_26_issue_qty']));?></td>
                                        <td><?php echo (($value['ot_dsg_28']) - ($value['ot_dsg_28_issue_qty']));?></td>
                                        <td><?php echo $total_qty;?></td>
                                    </tr>
                                    <?php
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
	$this->load->view('templates/footer');
?>