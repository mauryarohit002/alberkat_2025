<?php
//echo "<pre>";print_r($_SERVER);exit;
	$this->load->view('templates/header');

    if(isset($_GET['orderno'])){

        $order = $_GET['orderno'];
      
    }
    else{

        $order = "";

    }
?>
<script>
        var link = "report";
        var sub_link = "outward_bal_sumry_rp";
    </script>
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Outward Balance Summary Report
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Outward Balance Summary Report</li>
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
                                    <label for="inputEmail3" class="col-sm-2 control-label">Order No</label>
                                    <div class="col-sm-2">
                                        <select name="orderno" class="form-control" id="orderno">
                                            <option value="0">All</option>
                                                <?php
                                                    foreach ($order_no as $key => $value):
                                                        if($order != "" && $order == $value['om_id'])
                                                            echo "<option value='".$value['om_id']."' selected>".$value['om_order_no']."</option>";
                                                        else
                                                            echo "<option value='".$value['om_id']."'>".$value['om_order_no']."</option>";
                                                    endforeach;
                                                ?>
                                        </select>
                                    </div>
                                    <!-- <label for="inputEmail3" class="col-sm-1 control-label">Customer</label>
                                    <div class="col-sm-2">
                                        <select name="customer" class="form-control" id="customer">
                                            <option value="0" >Please Select</option>
                                            <?php
                                                foreach ($order_no as $key => $value):
                                                    if($cust_id != "" && $cust_id == $value['om_buyers_id'])
                                                        echo "<option value='".$value['om_buyers_id']."' selected>".$value['acc_name']."</option>";
                                                    else
                                                        echo "<option value='".$value['om_buyers_id']."'>".$value['acc_name']."</option>";
                                                endforeach;
                                            ?>
                                        </select>
                                    </div> -->
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary" style="width:100%;">Search</button>
                                    </div>
                                    <!-- <div class="col-sm-2">
                                        <?php 
                                            $url = $_SERVER['QUERY_STRING'];
                                        ?>            
                                        <a href="<?php echo base_url('creport/outward_bal_sumry_rp_export?'.$url)?>" class="btn btn-primary" style="width:100%;">Export</a>
                                    </div> -->
                                </div>
                                
                                <div class="form-group">
                                   
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
                            <?php if(!empty($order_trans_data)): ?>      
                                <div style="font-weight:bold;color:red">
                                    <span>O : order qty</span> / <span>I : issue qty</span> / <span>B : balance qty</span>
                                </div>
                            <?php endif;?>
                        </div>
                        <div class="box-body" style="overflow: auto;">
                        <?php if(!empty($order_trans_data)): ?>                        
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>  
                                        <th style="text-align:center" >Design No</th>
                                        <th style="text-align:center"  colspan="3">Size-12</th>
                                        <th style="text-align:center"  colspan="3">Size-14</th>
                                        <th style="text-align:center"  colspan="3">Size-16</th>
                                        <th style="text-align:center"  colspan="3">Size-18</th>
                                        <th style="text-align:center"  colspan="3">Size-20</th>
                                        <th style="text-align:center"  colspan="3">Size-22</th>
                                        <th style="text-align:center"  colspan="3">Size-24</th>
                                        <th style="text-align:center"  colspan="3">Size-26</th>
                                        <th style="text-align:center"  colspan="3">Size-28</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    <tr style="background:#ccc">
                                        <td style="border-right:1px solid #f42020;"></td>
                                        <td style="text-align:center;">O</td>
                                        <td style="text-align:center;">I</td>
                                        <td style="border-right:1px solid #f42020;">B</td>
                                        <td style="text-align:center;">O</td>
                                        <td style="text-align:center;">I</td>
                                        <td style="border-right:1px solid #f42020;">B</td>
                                        <td style="text-align:center;">O</td>
                                        <td style="text-align:center;">I</td>
                                        <td style="border-right:1px solid #f42020;">B</td>
                                        <td style="text-align:center;">O</td>
                                        <td style="text-align:center;">I</td>
                                        <td style="border-right:1px solid #f42020;">B</td>
                                        <td style="text-align:center;">O</td>
                                        <td style="text-align:center;">I</td>
                                        <td style="border-right:1px solid #f42020;">B</td>
                                        <td style="text-align:center;">O</td>
                                        <td style="text-align:center;">I</td>
                                        <td style="border-right:1px solid #f42020;">B</td>
                                        <td style="text-align:center;">O</td>
                                        <td style="text-align:center;">I</td>
                                        <td style="border-right:1px solid #f42020;">B</td>
                                        <td style="text-align:center;">O</td>
                                        <td style="text-align:center;">I</td>
                                        <td style="border-right:1px solid #f42020;">B</td>
                                        <td style="text-align:center;">O</td>
                                        <td style="text-align:center;">I</td>
                                        <td>B</td>
                                    </tr>

                                    <?php
                                        $count = isset($_GET['offset'])?$_GET['offset']:'0';
                                        foreach ($order_trans_data as $key => $value):
                                    ?>
                                    <tr>
                                        <td style="border-right:1px solid #f42020;"><?php echo $value['dsg_no'];?></td>
                                        <td><?php echo $value['ot_dsg_12'];?></td>
                                        <td><?php echo $value['ot_dsg_12_issue_qty'];?></td>
                                        <td style="border-right:1px solid #f42020;"><?php echo (($value['ot_dsg_12'])-($value['ot_dsg_12_issue_qty']));?></td>
                                        
                                        <td><?php echo $value['ot_dsg_14'];?></td>
                                        <td><?php echo $value['ot_dsg_14_issue_qty'];?></td>
                                        <td style="border-right:1px solid #f42020;"><?php echo (($value['ot_dsg_14'])-($value['ot_dsg_14_issue_qty']));?></td>
                                        
                                        <td><?php echo $value['ot_dsg_16'];?></td>
                                        <td><?php echo $value['ot_dsg_16_issue_qty'];?></td>
                                        <td style="border-right:1px solid #f42020;"><?php echo (($value['ot_dsg_16'])-($value['ot_dsg_16_issue_qty']));?></td>

                                        <td><?php echo $value['ot_dsg_18'];?></td>
                                        <td><?php echo $value['ot_dsg_18_issue_qty'];?></td>
                                        <td style="border-right:1px solid #f42020;"><?php echo (($value['ot_dsg_18'])-($value['ot_dsg_18_issue_qty']));?></td>

                                        <td><?php echo $value['ot_dsg_20'];?></td>
                                        <td><?php echo $value['ot_dsg_20_issue_qty'];?></td>
                                        <td style="border-right:1px solid #f42020;"><?php echo (($value['ot_dsg_20'])-($value['ot_dsg_20_issue_qty']));?></td>

                                        <td><?php echo $value['ot_dsg_22'];?></td>
                                        <td><?php echo $value['ot_dsg_22_issue_qty'];?></td>
                                        <td style="border-right:1px solid #f42020;"><?php echo (($value['ot_dsg_22'])-($value['ot_dsg_22_issue_qty']));?></td>

                                        <td><?php echo $value['ot_dsg_24'];?></td>
                                        <td><?php echo $value['ot_dsg_24_issue_qty'];?></td>
                                        <td style="border-right:1px solid #f42020;"><?php echo (($value['ot_dsg_24'])-($value['ot_dsg_24_issue_qty']));?></td>

                                        <td><?php echo $value['ot_dsg_26'];?></td>
                                        <td><?php echo $value['ot_dsg_26_issue_qty'];?></td>
                                        <td style="border-right:1px solid #f42020;"><?php echo (($value['ot_dsg_26'])-($value['ot_dsg_26_issue_qty']));?></td>

                                        <td><?php echo $value['ot_dsg_28'];?></td>
                                        <td><?php echo $value['ot_dsg_28_issue_qty'];?></td>
                                        <td><?php echo (($value['ot_dsg_28'])-($value['ot_dsg_28_issue_qty']));?></td>
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