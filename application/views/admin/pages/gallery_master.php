<?php
$this->load->view('admin/templates/header');
$role = $this->session->userdata("user_role_id");

if (isset($_GET['_status'])) 
{
    $_status = $_GET['_status'];
}
else
{
    $_status = "0";
}

?>
    <script>
        var link = "app_ac";
        var sub_link = "gallery";
    </script>
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="padding-top:0px;background:#fff;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Gallery Master 
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">
                Gallery Master </li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
       <br>
            <form class="form-horizontal" action="<?php echo base_url('admin/gallery_cmaster?action=view')?>">
				<div class="form-group">
					<div class="col-sm-4">
                        <label for="inputEmail3" class="control-label">Tital Name</label>
                        <select class="form-control floating-select" id="_title_name" name="_title_name">
                            <?php if(isset($gallery_data['search']['_title_name']) && !empty($gallery_data['search']['_title_name'])): ?>
                                <option value="<?php echo $gallery_data['search']['_title_name']['value']; ?>" selected>
                                    <?php echo $gallery_data['search']['_title_name']['text']; ?> 
                                </option>
                            <?php endif; ?>
                        </select> 
                    </div>
                    <div class="col-sm-2">
                        <label for="inputEmail3" class="control-label">Status</label>
                        <select name="_status" class="form-control cust_bt_border" id="_status">
                            <option value="0" <?php echo ($_status =='0')?'selected':''?>>please select</option>
                            <option value="1" <?php echo ($_status =='1')?'selected':''?>>Active</option>
                            <option value="2" <?php echo ($_status =='2')?'selected':''?>>Inactive</option>
                        </select>
                    </div>

                    <div class="col-sm-1">
                        <label for="inputEmail3" class="control-label"></label>
                        <button type="submit" id="search_form" class="btn btn-primary cust_search_btn">Search</button>
                    </div>
                    <div class="col-sm-1">
                        <label for="inputEmail3" class="control-label"></label>
                        <a href="<?php echo base_url('admin/gallery_cmaster?action=view')?>" type="button" class="btn btn-primary cust_search_btn" style="width:100%;"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;&nbsp;Reset</a>
                    </div>
                    <div class="col-sm-1">
                        <label for="inputEmail3" class="control-label"></label>
                        <a href="<?php echo base_url('admin/gallery_cmaster?action=add')?>" type="button" class="btn btn-primary cust_search_btn" style="width:100%;"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add</a>
                    </div>
				</div>
            </form>
            
            <div class="alert_msg"></div>
            <div class="row">
                <div class="col-md-12">     
                    <div class="box">
                        <div class="box-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title Name</th>
                                        <th>Status</th>
                                        <th>Edit</th>   
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                        <?php
							if (!empty($gallery_data['data'])):
						?>
                                <tbody>
                                    <?php
                                    $cnt = 1;
                                    foreach ($gallery_data['data'] as $key => $value) :
                                        $gallery_id     = encrypt_decrypt("encrypt", $value['gallery_id'], SECRET_KEY);
                                    ?>
                                        <tr class="tr_bottom">
                                            <td><?php echo $cnt ?></td>
                                            <td><?php echo $value['gallery_title_name']; ?></td>
                                            <td><?php echo ($value['gallery_status']==1)?'Active':'Inactive'; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('admin/gallery_cmaster?action=edit&id='.$gallery_id)?>" type="button" class="glyphicon  glyphicon glyphicon-pencil dash_cust_btn_view" ></a>
                                                
                                            </td>
                                            <td><button class="glyphicon glyphicon-trash dash_cust_btn_view" onClick="delete_gallery('<?php echo $gallery_id; ?>');"></button></td>
                                        </tr>
                                    <?php
                                    $cnt++;
                                    endforeach;
                                    ?>
                                </tbody>
                        <?php 
                                echo $this->pagination->create_links();
                        else:
                            echo "<tr><td colspan='4'><h1 class='text-center'>No result found!</h1><td></tr>";
                        endif;
                        ?>    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       </div>
       
<?php
    $this->load->view('admin/templates/footer');
?>
<script src="<?php echo assets('admin/js/gallery.js?v=1')?>"></script>