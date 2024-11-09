<?php
//echo "<pre>";print_r($_SERVER);exit;
	$this->load->view('templates/header');

    if(isset($_GET['orderno'])){

        $order = $_GET['orderno'];
        $cust_id = $_GET['customer'];
    }
    else{

        $order = "";
        $cust_id = ""; 
    }
?>
<script>
        var link = "report";
        var sub_link = "order_bal_sumry_rp";
    </script>
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Order Balance Summary Report
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Order Balance Summary Report</li>
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
                                                        if($order != "" && $order == $value['om_order_no'])
                                                            echo "<option value='".$value['om_order_no']."' selected>".$value['om_order_no']."</option>";
                                                        else
                                                            echo "<option value='".$value['om_order_no']."'>".$value['om_order_no']."</option>";
                                                    endforeach;
                                                ?>
                                        </select>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 control-label">Customer</label>
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
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary" style="width:100%;">Search</button>
                                    </div>
                                    <div class="col-sm-2">
                                        <?php 
                                            $url = $_SERVER['QUERY_STRING'];
                                        ?>            
                                        <a href="<?php echo base_url('creport/order_bal_sumry_rp_export?'.$url)?>" class="btn btn-primary" style="width:100%;">Export</a>
                                    </div>
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
                        </div>
                        <div class="box-body">
                        <?php if(!empty($order_data)): ?>                        
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>    
                                        <th>Order No</th>
                                        <th>Order Qty</th>
                                        <th>Issue Qty</th>        
                                        <th>Balance Qty</th>
                                    </tr>
                                </thead>
                               
                                <tbody>

                            <?php
                                $count = isset($_GET['offset'])?$_GET['offset']:'0';
                                foreach ($order_data as $key => $value):
                            ?>
                                    <tr>
                                        <td><?php echo ++$count;?></td>
                                        <td><?php echo $value['om_order_no'];?></td>
                                        <td><?php echo $value['om_total_qty'];?></td>
                                        <td><?php echo $value['om_total_issue_qty'];?></td>
                                        <td><?php echo (($value['om_total_qty'])-($value['om_total_issue_qty']));?></td>
                                        
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