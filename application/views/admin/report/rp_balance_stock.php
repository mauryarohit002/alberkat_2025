<?php
//echo "<pre>";print_r($_SERVER);exit;
	$this->load->view('templates/header');

    if(isset($_GET['design_no'])){

        $design_no = $_GET['design_no'];
        $stock = $_GET['stock'];
    }
    else{

        $design_no = "";
        $stock = ""; 
    }
?>
<script>
        var link = "report";
        var sub_link = "balance_stock_rp";
    </script>
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Stock Report
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Stock Report</li>
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
                            <form class="form-horizontal" id="report_search_form" action="<?php echo base_url('creport/balance_stock_rp')?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Design No</label>
                                    <div class="col-sm-2">
                                        <select name="design_no" class="form-control" id="design_no">
                                            <option value="0">All</option>
                                                <?php
                                                    foreach ($design_data as $key => $value):
                                                        if($design_no != "" && $design_no == $value['dsg_id'])
                                                            echo "<option value='".$value['dsg_id']."' selected>".$value['dsg_no']."</option>";
                                                        else
                                                            echo "<option value='".$value['dsg_id']."'>".$value['dsg_no']."</option>";
                                                    endforeach;
                                                ?>
                                        </select>
                                    </div>
                                    <!-- <label for="inputEmail3" class="col-sm-2 control-label">Results Per Page</label>
                                    <div class="col-sm-2">
                                        <select name="per_page" class="form-control" id="per_page">
                                            <option value="10" <?php echo ($per_page=="10")?"selected":""?>>10</option>
                                            <option value="25" <?php echo ($per_page=="25")?"selected":""?>>25</option>
                                            <option value="50" <?php echo ($per_page=="50")?"selected":""?>>50</option>
                                            <option value="100" <?php echo ($per_page=="100")?"selected":""?>>100</option>
                                        </select>
                                    </div> -->
                                    <label for="inputEmail3" class="col-sm-1 control-label">Stock</label>
                                    <div class="col-sm-2">
                                        <select name="stock" class="form-control" id="stock">
                                            <option value="0" >Please Select</option>
                                            <option value="grt_thn_0" <?php echo ($stock=="grt_thn_0")?"selected":""?>>stock > 0</option>
                                            <option value="eql_to_0" <?php echo ($stock=="eql_to_0")?"selected":""?>>stock = 0</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary" style="width:100%;">Search</button>
                                    </div>
                                    <div class="col-sm-2">
                                        <?php 
                                            $url = $_SERVER['QUERY_STRING'];
                                        ?>            
                                        <a href="<?php echo base_url('creport/balance_stock_rp_export?'.$url)?>" class="btn btn-primary" style="width:100%;">Export</a>
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
                        <?php
                            if(!empty($design)):
                        ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>    
                                        <th>Design No</th>
                                        <th>Size-12</th>
                                        <th>Size-14</th>        
                                        <th>Size-16</th>
                                        <th>Size-18</th>
                                        <th>Size-20</th>
                                        <th>Size-22</th>
                                        <th>Size-24</th>
                                        <th>Size-26</th>
                                        <th>Size-28</th>
                                        <th>Total</th>   
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                $count = isset($_GET['offset'])?$_GET['offset']:'0';
                                foreach ($design as $key => $value):
                            ?>
                                    <tr>
                                        <td><?php echo ++$count;?></td>
                                        <td><?php echo $value['dsg_no'];?></td>
                                        <td><?php echo $value['dsg_design_12'];?></td>
                                        <td><?php echo $value['dsg_design_14'];?></td>
                                        <td><?php echo $value['dsg_design_16'];?></td>
                                        <td><?php echo $value['dsg_design_18'];?></td>
                                        <td><?php echo $value['dsg_design_20'];?></td>
                                        <td><?php echo $value['dsg_design_22'];?></td>
                                        <td><?php echo $value['dsg_design_24'];?></td>
                                        <td><?php echo $value['dsg_design_26'];?></td>
                                        <td><?php echo $value['dsg_design_28'];?></td>
                                        <td><?php echo $value['total_dsg_qty'];?></td>
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