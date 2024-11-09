<?php $this->load->view('templates/temp_header') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="text-center" style="font-weight: bold;">APPLICATION STATUS - 
                        <span style="color: red;text-transform: uppercase;">
                            <?php 
                                $status = $student_data[0]['rm_app_status'];

                                switch ($status) {
                                    case "0":
                                        echo "Pending";
                                        break;
                                    case "1":
                                        echo "Incomplete Application";
                                        break;
                                    case "2":
                                        echo "Photo Not Proper";
                                        break;
                                    case "3":
                                        echo "Payment Not Done";
                                        break;
                                    case "4":
                                        echo "Application Print Done";
                                        break;
                                    case "5":
                                        echo "Verification Schedule";
                                        break;
                                    case "6":
                                        echo "Application Rejected";
                                        break;
                                    case "7":
                                        echo "Admission Confirm";
                                        break;
                                    case "8":
                                        echo "Fees Not Paid";
                                        break;
                                    case "9":
                                        echo "Absent For Interview";
                                        break;
                                    default:
                                        echo "Status Not available";
                                }
                                // echo " ";
                                // echo date('d-m-Y',strtotime($student_data[0]['rm_update_date']));
                            ?>
                        </span></h4>
                        <br>
                    <table class="table table-striped">
                        <tr><td class="pr_header" colspan="4"><h4>Registration Details</h4></td></tr>
                        <tr></tr>
                        <tr>
                        <th class="pr_title">Application No.</th>
                        <td class="pr_data"><?php echo $student_data[0]['rm_app_no'] ?></td>
                        <th class="pr_title">Date</th>
                        <td class="pr_data"><?php echo date('d-m-Y', strtotime($student_data[0]['rm_reg_date']))?></td>
                        </tr>
                        <tr>
                        <th class="pr_title">Mobile No.</th>
                        <td class="pr_data"><?php echo $student_data[0]['rm_parent_mob_no']?></td>
                        <th class="pr_title">Class</th>
                        <td class="pr_data"><?php echo $student_data[0]['rm_child_class']?></td>
                        </tr>
                        <tr></tr>
                        <tr><td class="pr_header" colspan="4"><h4>Student Details</h4></td></tr>
                        <tr>
                        <th class="pr_title">student name</th>
                        <td class="pr_data"><?php echo $student_data[0]['rm_child_surname']." ".$student_data[0]['rm_child_name']." ".$student_data[0]['rm_child_father_name']?></td>
                        <th class="pr_title">gender</th>
                        <td class="pr_data"><?php echo $student_data[0]['rm_child_gender'] == 'M' ? 'MALE' :'FEMALE' ?></td>
                        </tr>
                        <tr>
                        <th class="pr_title">Date of Birth</th>
                        <td class="pr_data"><?php echo date('d-m-Y', strtotime($student_data[0]['rm_child_birth_date']))?></td>
                        <th class="pr_title">place of bitrh</th>
                        <td class="pr_data"><?php echo $student_data[0]['rm_child_birth_town'] ?></td>
                        </tr>
                       
                </table>
                <br>
                <table class="table table-striped">
                    <tr><th colspan="3"><h4 style="font-weight: bold;">SMS Details</h4></th></tr>
                    <tr>
                        <th width="5%">SR NO.</th>
                        <th width="15%">Received Date</th>
                        <th width="80%">Messages</th>
                    </tr>

                    <?php foreach ($sms_data as $key => $value): ?>
                        <tr>
                        <td width="5%"><?php echo $key+1 ?></td>
                        <td><?php echo date('d-m-Y H:i:s',strtotime($value['msg_send_date']))?></td>
                        <td><?php echo $value['msg_content']?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                </div>
            </div>
        </div>
    </div>   
</div>
</body>
</html>