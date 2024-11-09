<?php
    $this->load->view('templates/header');
?>
    <script>
        var link = "master";
        var sub_link = "user";
    </script>
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User Master
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User Master</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-2 col-md-offset-10">
                    <a onClick="add_update_user_popup(0);" class="btn btn-primary" style="width:100%;">Add New</a>
                </div>
            </div>
            <hr />
            <div class="alert_msg"></div>
            <div class="row">
                <div class="col-md-12">     
                    <div class="box">
                        <div class="box-body">
                            <table class="table table-bordered table-striped master_table">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Telephone</th>
                                        <th>Mobile</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                foreach ($user_data as $key => $value):
                                    $role_id = $value['user_role_id'];
                            ?>
                                    <tr>
                                        <td><?php echo $key+1?></td>
                                        <td><?php echo $value['user_name']?></td>
                                        <td><?php echo $role[$role_id]?></td>
                                        <td><?php echo $value['user_telephone']?></td>
                                        <td><?php echo $value['user_mobile']?></td>
                                        <td><span class="glyphicon glyphicon-pencil" style="cursor:pointer;" onClick="add_update_user_popup(<?php echo $value['user_id']?>)"></span></td>
                                        <td><span class="glyphicon glyphicon-trash" onClick="delete_item(<?php echo $value['user_id']?>,'user_delete');"></span></td>
                                    </tr> 
                            <?php
                                endforeach;
                            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       </div>
<?php
    $this->load->view('templates/footer');
?>