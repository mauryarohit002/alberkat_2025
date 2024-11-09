<?php
$this->load->view('admin/templates/header');
$role = $this->session->userdata("user_role_id");
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
                Gallery <?php echo (!empty($data))?'Edit':'Add' ?> 
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">
                Gallery <?php echo (!empty($data))?'Edit':'Add' ?>  </li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
       <br>
            <form class="form-horizontal" id="gallery_form">
                <div class="alert_msg"></div>
                <div class="form-group">
                    <div class="col-sm-2 col-md-3">
                        <label for="inputEmail3" class="control-label">Gallery Title</label>
                        <input class="form-control" name="gallery_title_name" id="gallery_title_name" value="<?php echo !empty($data) ? $data[0]['gallery_title_name'] :''; ?>" placeholder="" >
                    </div>
                    <div class="col-sm-2">
                        <label for="inputEmail3" class="control-label">Status</label>
                        <select name="gallery_status" class="form-control cust_bt_border" id="gallery_status">
                            <option value="1" <?php echo (!empty($data) && $data[0]['gallery_status'] =='1')?'selected':''?>>Active</option>
                            <option value="2" <?php echo (!empty($data) && $data[0]['gallery_status'] =='2')?'selected':''?>>Inactive</option>
                        </select>
                    </div>

                    <div class="col-sm-1">
                        <label for="inputEmail3" class="control-label"></label>
                        <a type="button" class="btn btn-primary cust_search_btn" onclick="add_update_gallery(<?php echo !empty($data) ? $data[0]['gallery_id'] : 0; ?>)" style="width:100%;">&nbsp;&nbsp;<?php echo !empty($data) ? "Update" : "Submit"; ?></a>
                    </div>
                    <div class="col-sm-1">
                        <label for="inputEmail3" class="control-label"></label>
                        <a href="<?php echo base_url('admin/gallery_cmaster?action=view')?>" type="button" class="btn btn-primary cust_search_btn" style="width:100%;">cancel</a>
                    </div>
                </div>
                <div class="form-group">
                </div>    
                <div class="form-group">
                    <div class="col-sm-2 col-md-2">
                        <label for="inputEmail3" class="control-label">Add Gallery Image</label>
                        <input type="file" class="form-control" name="gallery_image[]" id="gallery_image"  placeholder="" multiple>
                    </div>
                    <div class="col-sm-1">
                        <label for="inputEmail3" class="control-label"></label>
                        <a type="button" class="btn btn-primary" onclick="add_gallery_image(<?php echo !empty($data) ? $data[0]['gallery_id'] : 0; ?>)" style="width:100%;">&nbsp;&nbsp;Add</a>
                    </div>
                </div>   
                <div class="form-group" id="image_wrapper">   
                    <?php 
                        $img_cnt=1;
                        if(!empty($data[0]['gallery_image'])):
                            foreach($data[0]['gallery_image'] as $key => $value):
                     ?>
                    <div class="col-sm-6 col-md-2 col-lg-2" id="irowid_<?php echo $img_cnt; ?>">
                        <img 
                            class="img-thumbnail pan form_loading" 
                            onclick="zoom(this)" 
                            title="click to zoom in and zoom out" 
                            src="<?php echo empty($value)?assets(NO_IMAGE):$value; ?>" 
                            data-big="<?php echo empty($value)?assets(NO_IMAGE):$value; ?>" 
                            style="width: 200px; height: 200px; object-fit: contain;"
                        />
                        <input type="hidden" class="form-control" name="gallery_image[]" id="gallery_image_<?php echo $img_cnt; ?>"  value="<?php echo empty($value)?assets(NO_IMAGE):$value; ?>" placeholder="" >

                        <br>
                        <br>
                        <a type="button" class="btn btn-primary" onclick="remove_gallery_image(<?php echo $img_cnt; ?>)" style="width:100%;">&nbsp;&nbsp;Remove</a>
                    </div>
                    <?php 
                            $img_cnt++;
                            endforeach;
                        endif;
                    ?>
                </div>
            </form>
            
            
        </section>
       </div>
       
<?php
    $this->load->view('admin/templates/footer');
?>
<script src="<?php echo assets('admin/js/gallery.js?v=1')?>"></script>