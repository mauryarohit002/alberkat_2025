<?php
	// echo"<pre>";print_r($data);exit;
	$this->mypdf_class->tcpdf();
	$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "Student_details_Report_".rand(10,100);
	$obj_pdf->SetTitle($title);
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT-10, 2, PDF_MARGIN_RIGHT-10);
	$obj_pdf->SetAutoPageBreak(TRUE, 11);
	$obj_pdf->SetFont('helvetica', '', 11);
	$obj_pdf->setFontSubsetting(true);
    $obj_pdf->setPrintHeader(false);
	//$obj_pdf->RoundedRectXY(0.5,0.5,100,100,10,10,'1111','','','');

	$obj_pdf->AddPage();
	ob_start();

?>
<div id="">
	<h3>STUDENT DETAILS REPORT</h3>
    <table border="1" cellpadding="3" style="font-size: 8px;">
        <tr>
            <th style="width:6%;">APP NO</th>
            <!-- <th style="width:10%;">DATE OF <br>SUBMISSION</th> -->
            <th style="width:5%;">INCOME</th>
            <th style="width:10%;">CHILD DETAILS</th>
            <th style="width:10%;">FATHER DETAILS</th>
            <th style="width:10%;">MOTHER DETAILS</th>
            <th style="width:10%;">GUARDIAN DETAILS</th>
            <th style="width:8%;">STATUS</th>
            <!-- <th style="width:10%;">ADDRESS</th> -->
            <!-- <th style="width:10%;">SIBLING</th> -->
            <th style="width:41%;">MESSAGE</th>
        </tr>
        <?php
            foreach ($reg_data as $key => $value) :
        ?>
            <tr>
                <td><?php echo $value['rm_app_no']; ?></td>
                <!-- <td><?php echo date('d-m-Y', strtotime($value['rm_reg_date'])); ?></td> -->
                <td><?php echo $value['rm_child_family_monthly_income'] ?></td>
                <td><?php echo "NAME : ".$value['rm_child_name'] . "<br/>" . "DOB : ".date('d-m-Y', strtotime($value['rm_child_birth_date'])). "<br/>" . "MOB : ".$value['rm_parent_mob_no'] ?>
                </td>
                <td><?php echo "NAME : ".$value['rm_child_father_name'] . " ".$value['rm_child_father_last_name'] . "<br/>" . "QUALI : " . $value['rm_child_father_qualification'] . "<br/>" . "OCCU : ".$value['rm_child_father_occupation'] ?></td>
                <td><?php echo "NAME : ".$value['rm_child_mother_name'] . " ".$value['rm_child_father_last_name'] . "<br/>" . "QUALI : ".$value['rm_child_mother_qualification'] . "<br/>" . "OCCU : ".$value['rm_child_mother_occupation'] ?></td>
                <td><?php echo "NAME : ".$value['rm_child_guardian_fname'] . " ".$value['rm_child_guardian_lname'] . "<br/>" . "OCCU : ".$value['rm_child_guardian_occupation'] ?></td>
                
                <td><?php 
                        if ($value['rm_app_status'] == 0) 
                        {
                            echo "PENDING";
                        }
                        elseif ($value['rm_app_status'] == 1) 
                        {
                            echo "INCOMPLETE APPLICATION";
                        }
                        elseif ($value['rm_app_status'] == 2) 
                        {
                            echo "PHOTO NOT PROPER";
                        }
                        elseif ($value['rm_app_status'] == 3) 
                        {
                            echo "PAYMENT NOT DONE";
                        }
                        elseif ($value['rm_app_status'] == 4) 
                        {
                            echo "APPLICATION PRINT DONE";
                        }
                        elseif ($value['rm_app_status'] == 5) 
                        {
                            echo "VERIFICATION SCHEDULE";
                        }
                        elseif ($value['rm_app_status'] == 6) 
                        {
                            echo "APPLICATION REJECTED";
                        }
                        elseif ($value['rm_app_status'] == 7) 
                        {
                            echo "ADMISSION CONFIRM";
                        }
                        elseif ($value['rm_app_status'] == 8) 
                        {
                            echo "FEES NOT PAID";
                        }
                        elseif ($value['rm_app_status'] == 9) 
                        {
                            echo "ABSENT FOR INTERVIEW";
                        }

                    ?>
                </td>
               <!--  <td>
                    <?php echo $value['rm_child_per_add_house_no'].", ".$value['rm_child_per_add_town'].", ".$value['rm_child_per_add_pin_code'].", ".$value['rm_child_per_add_state'].", ".$value['rm_child_per_add_municipality_ward']?>
                </td> -->
                <!-- <td>
                    <?php 
                        if ($value['rm_sibling_flag'] == 1) {
                            echo "YES";
                        } else {
                            echo "NO";
                        } 
                    ?>
                </td> -->
                <td>
                    <?php echo $value['rm_message']; ?>
                </td>

            </tr>
        <?php
            endforeach;
        ?>
    </table>
</div>
<?php
	$content = ob_get_contents();
	ob_end_clean();
	$obj_pdf->writeHTML($content, false, false, false, false, '');
	$obj_pdf->Output('output.pdf', 'I');
?>
