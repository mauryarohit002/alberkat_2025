<?php

	$this->mypdf_class->tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "Scenario Consensus";
	$file_name = 1;

	$obj_pdf->SetTitle($title);
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('helvetica', '', 11);
	$obj_pdf->setFontSubsetting(true);
	
	$obj_pdf->SetPrintHeader(false);
	$obj_pdf->SetPrintFooter(false);

	//$obj_pdf->startPageGroup();
	$obj_pdf->AddPage();

	$obj_pdf->SetFont('Helvetica', 'B', 12);

	//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
	//MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

	// $obj_pdf->cell(190,7,$title,0,'','C',0,'',1,false,'T','M');
	// $obj_pdf->Line(10, 20, 200, 20, '');
	// $obj_pdf->Ln(20);

	$project_name = $event_master_data[0]['em_name'];
	$date = date("d-m-Y",strtotime($event_master_data[0]['em_date_create']));
	$ref_no = $event_master_data[0]['em_ref_no'];
	$user_full_name = $event_master_data[0]['user_full_name'];
	$em_objective = $event_master_data[0]['em_objective'];
	$image_path = base_url('public/assets/images/logore.png');
	$tbl = "";


$tbl .= <<<EOD

<table class="table table-bordered" style="" border="0">
<tr style="font-size:10px;">
<td width="200"><img src="$image_path" width="150" height="50"/></td>
<td style="vertical-align:middle;text-align:left;font-size:16px;"><br/><br/>$title</td>
</tr>

</table>

<table class="table table-bordered" style="" border="1" cellpadding="5">
<tr style="background-color:white;color:black;font-size:10px;">
		<td width="25%">Project Name : $project_name</td>
		<td width="25%">Entery Date : $date</td>
		<td width="25%">Ref No : $ref_no</td>
		<td width="25%">Project Lead : $user_full_name</td>

</tr>

<tr style="background-color:white;color:black;font-size:10px;">
		<td width="100%">Key Objective : $em_objective</td>	
</tr>

</table>

<br/><br/>
<table class="table table-bordered" style="" border="1" cellpadding="5">
<tr style="background-color:#093334;color:white;font-size:9px;">
<th width="30%" style="font-size: 12px;border-radius: 10px;font-weight: normal;background-color: #333333;color: white;">Event Name</th>
<th width="35%" style="font-size: 12px;border-radius: 10px;font-weight: normal;background-color: #333333;color: white;">Downside</th>
<th width="35%" style="font-size: 12px;border-radius: 10px;font-weight: normal;background-color: #333333;color: white;">Upside</th>
</tr>

EOD;

	// foreach ($form_data as $key => $value)
	// {
	// 	echo"<pre>";print_r($form_data);exit;
	// 	// $ev_name   = $value['ev_name'][$key];
		
	// }

  foreach ($print_data as $key => $value)
    {
    	// echo"<pre>";print_r($print_data);exit;
    	$ev_name   = $value['ev_name'];
		$sr_dw_desp = $value['se_dw_desp'];
		$sr_up_desp = $value['se_up_desp'];
$tbl .= <<<EOD
<tr style="font-size:8px;font-weight:normal;">
EOD;
		if($key != 0 && $value['ev_id'] == $print_data[$key-1]['ev_id'])
		{

			$tbl .= <<<EOD
			<td colspan="2"></td>
EOD;
		}

		else
		{

			$tbl .= <<<EOD
			<td>$ev_name</td>
			
			<td>$sr_dw_desp</td>
			<td>$sr_up_desp</td>

EOD;
		}


		$tbl .= <<<EOD
		
		</tr>
EOD;
    }

 


//




$tbl .= <<<EOD
</table><br /><br />
EOD;

	$obj_pdf->writeHTML($tbl, true, false, false, false, '');
	$height = $obj_pdf->getY();
	//echo $height;
	//$obj_pdf->writeHTML($height, true, false, false, false, '');

	$obj_pdf->Output($file_name, 'I');
?>