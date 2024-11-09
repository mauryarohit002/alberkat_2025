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
	<h3>STUDENT APPLICATION PROGRESS REPORT</h3>
    <table border="1" cellpadding="3" style="font-size: 8px;">
        <tr>
            <th style="width: 7%;">APP NO</th>
            <th style="width: 7%;">DATE OF <br>SUBMISSION</th>
            <th style="width: 10%;">CHILD DETAILS</th>
            <th style="width: 10%;">FATHER DETAILS</th>
            <th style="width: 10%;">MOTHER DETAILS</th>
            <th style="width: 23%;">PROGRESS DETAILS</th>
            <th style="width: 10%;">CURRENT STATUS</th>
            <th style="width: 10%;">GR NO</th>
            <th style="width: 13%;">SIBLING DETAILS</th>
        </tr>
        <?php
        if (!empty($app_data)):
            foreach ($app_data as $key => $value) :
        ?>
            <tr>
                <td><?php echo $value['data']['rm_app_no']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($value['data']['rm_reg_date'])); ?></td>
                <td><?php echo "NAME : ".$value['data']['rm_child_name'] . "<br/>" . "DOB : ".date('d-m-Y', strtotime($value['data']['rm_child_birth_date'])). "<br/>" . "MOB : ".$value['data']['rm_parent_mob_no'] ?>
                </td>
                <td><?php echo "NAME : ".$value['data']['rm_child_father_name'] . " ".$value['data']['rm_child_father_last_name'] . "<br/>" . "QUALI : " . $value['data']['rm_child_father_qualification'] . "<br/>" . "OCCU : ".$value['data']['rm_child_father_occupation'] ?></td>

                 <td><?php echo "NAME : " . $value['data']['rm_child_mother_name'] . " " . $value['data']['rm_child_father_last_name'] . "\n" . "QUALI : " . $value['data']['rm_child_mother_qualification'] . "\n" . "OCCU : " . $value['data']['rm_child_mother_occupation'] ?></td>
                <td>
                    <table class="table" cellpadding="5">
                        <tr>
                            <th style="border-bottom: 1px solid #000;">DATE</th>
                            <th style="border-bottom: 1px solid #000;">STATUS</th>
                        </tr>
                        <?php 
                            foreach ($value['data']['app_progress'] as $key2 => $value2): 
                        ?>

                        <tr>
                            <td style="border-bottom: 1px solid #000;"><?php echo date('d-m-Y',strtotime($value2['rt_status_date']))?></td>
                            <td style="border-bottom: 1px solid #000;"><?php echo $app_status[$value2['rt_rm_status']] ?></td>
                        </tr>

                        <?php 
                            endforeach;
                        ?>
                    </table>
                </td>
                <td>
                    <?php echo $app_status[$value['data']['rm_app_status']]  ?>
                </td>

                <td>
                    <?php echo $value['data']['rm_child_gr_no']  ?>
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

            </tr>
        <?php
            endforeach;
       	endif;
        ?>
    </table>
</div>
<?php
	$content = ob_get_contents();
	ob_end_clean();
	$obj_pdf->writeHTML($content, false, false, false, false, '');
	$obj_pdf->Output('output.pdf', 'I');
?>
