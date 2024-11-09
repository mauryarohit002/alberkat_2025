<?php

	$this->mypdf_class->tcpdf();
	$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "ProACT Planning";

	$file_name = 'ProACT_Planning_'.$em_id.'.pdf';
	// echo"<pre>";print_r($file_name);exit;
	$file_path = 'public/uploads/pdf_file/'.$file_name;

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

	// $obj_pdf->cell(390,7,$title,0,'','C',0,'',1,false,'T','M');
	// $obj_pdf->Line(10, 20, 200, 20, '');
	// $obj_pdf->Ln(20);


	$em_name = $event_master[0]['em_name'];
	$em_objective = $event_master[0]['em_objective'];
	$date = date("d-m-Y",strtotime($event_master[0]['em_date_create']));
	$ref_no = $event_master[0]['em_ref_no'];
	$em_user_id = $event_master[0]['em_user_id'];
	$user_full_name = $event_master[0]['user_full_name'];
	$complete_date = date("d-m-Y",strtotime($actionability_result[0]['acm_cdate']));
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
		<td width="25%">Project Name : $em_name</td>
		<td width="25%">Entry Date : $date</td>
		<td width="25%">Ref No : $ref_no</td>
		<td width="25%">Project Lead : $user_full_name</td>

</tr>

<tr style="background-color:white;color:black;font-size:10px;">
		<td width="50%">Key Objective : $em_objective</td>	
		<td width="50%">Completion Date  : $complete_date</td>	
</tr>

</table>

<table border="1" cellpadding="4" style="font-size:8px;">

	
		<tr>
			<td width="100%" style="background-color:white;color:black;font-size:13px;text-align:center;">Tactical Planning (Short to Medium Term)</td>
		</tr>
	</table>


	
	<table border="1" cellpadding="4" style="font-size:8px;">

EOD;


	foreach ($actionability_result as $key => $value)
	{
		// $ev_name   = $value['ev_name'];
		$ev_id = $value['acm_ev_id'];
		$risk = $value['acm_risk'];
		$acm_sm1 = $value['acm_sm1'];
		$acm_sm2 = $value['acm_sm2'];
		$acm_sm3 = $value['acm_sm3'];
		$acm_sm4 = $value['acm_sm4'];
		$acm_sm5 = $value['acm_sm5'];
		$acm_sm6 = $value['acm_sm6'];
		$acm_sm7 = $value['acm_sm7'];
		$acm_sm8 = $value['acm_sm8'];
		$acm_sm9 = $value['acm_sm9'];
		// $acm_sm10 = $value['acm_sm10'];
		// echo"<pre>";print_r($value);exit;
		$tbl .= <<<EOD
	
		
		
			<tr style="color:black;font-size:10px;">

		<th width="10%" style="border-radius: 10px;font-weight: normal;background-color:#093334;color:white;"><b>Event Id</b></th>
		<th width="15%" style="border-radius: 10px;font-weight: normal;background-color:red;color:white;"><b>RISK & Opportunity</b></th>
		<th width="45%" style="border-radius: 10px;font-weight: normal;background-color:#fbe5d6;color:black;"><b>$risk</b></th>
		<th width="15%" style="border-radius: 10px;font-weight: normal;background-color:#093334;color:white;"><b>Responsibility</b></th>
		<th width="15%" style="border-radius: 10px;font-weight: normal;background-color:#093334;color:white;"><b>Timeline</b></th>
		

		</tr>

		<tr style="color:black;font-size:7px;">
			<th width="10%" style="border-radius: 10px;font-weight: normal;">$ev_id</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">Action & Tactics1</th>
			<th width="45%" style="border-radius: 10px;font-weight: normal;">$acm_sm1</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">$acm_sm2</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">$acm_sm3</th>
			
		</tr>

		<tr style="color:black;font-size:7px;">
			<th width="10%" style="border-radius: 10px;font-weight: normal;"></th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">Action & Tactics2</th>
			<th width="45%" style="border-radius: 10px;font-weight: normal;">$acm_sm4</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">$acm_sm5</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">$acm_sm6</th>
			
		</tr>

		<tr style="color:black;font-size:7px;">
			<th width="10%" style="border-radius: 10px;font-weight: normal;"></th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">Action & Tactics3</th>
			<th width="45%" style="border-radius: 10px;font-weight: normal;">$acm_sm7</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">$acm_sm8</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">$acm_sm9</th>
			
		</tr>
	
EOD;
	}
	$tbl .= <<<EOD
	</table><br/><br/>


	<table border="1" cellpadding="4" style="font-size:8px;">

		<tr>
			<td width="100%" style="background-color:white;color:black;font-size:13px;text-align:center;">Tactical Planning (Medium To Long Term)</td>
		</tr>
	</table>


	
	<table border="1" cellpadding="4" style="font-size:8px;">

EOD;


	foreach ($actionability_result as $key => $value)
	{
		// $ev_name   = $value['ev_name'];
		$ev_id = $value['acm_ev_id'];
		$risk = $value['acm_risk'];
		$acm_ml1 = $value['acm_ml1'];
		$acm_ml2 = $value['acm_ml2'];
		$acm_ml3 = $value['acm_ml3'];
		$acm_ml4 = $value['acm_ml4'];
		$acm_ml5 = $value['acm_ml5'];
		$acm_ml6 = $value['acm_ml6'];
		$acm_ml7 = $value['acm_ml7'];
		$acm_ml8 = $value['acm_ml8'];
		$acm_ml9 = $value['acm_ml9'];
		// $acm_sm10 = $value['acm_sm10'];
		// echo"<pre>";print_r($value);exit;
		$tbl .= <<<EOD
	
		
		
			<tr style="color:black;font-size:10px;">

		<th width="10%" style="border-radius: 10px;font-weight: normal;background-color:#093334;color:white;"><b>Event Id</b></th>
		<th width="15%" style="border-radius: 10px;font-weight: normal;background-color:red;color:white;"><b>RISK & Opportunity</b></th>
		<th width="45%" style="border-radius: 10px;font-weight: normal;background-color:#fbe5d6;color:black;"><b>$risk</b></th>
		<th width="15%" style="border-radius: 10px;font-weight: normal;background-color:#093334;color:white;"><b>Responsibility</b></th>
		<th width="15%" style="border-radius: 10px;font-weight: normal;background-color:#093334;color:white;"><b>Timeline</b></th>
		

		</tr>

		<tr style="color:black;font-size:7px;">
			<th width="10%" style="border-radius: 10px;font-weight: normal;">$ev_id</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">Action & Tactics1</th>
			<th width="45%" style="border-radius: 10px;font-weight: normal;">$acm_ml1</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">$acm_ml2</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">$acm_ml3</th>
			
		</tr>

		<tr style="color:black;font-size:7px;">
			<th width="10%" style="border-radius: 10px;font-weight: normal;"></th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">Action & Tactics2</th>
			<th width="45%" style="border-radius: 10px;font-weight: normal;">$acm_ml4</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">$acm_ml5</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">$acm_ml6</th>
			
		</tr>

		<tr style="color:black;font-size:7px;">
			<th width="10%" style="border-radius: 10px;font-weight: normal;"></th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">Action & Tactics3</th>
			<th width="45%" style="border-radius: 10px;font-weight: normal;">$acm_ml7</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">$acm_ml8</th>
			<th width="15%" style="border-radius: 10px;font-weight: normal;">$acm_ml9</th>
			
		</tr>
	
EOD;
	}
	$tbl .= <<<EOD
	</table><br/><br/>
EOD;

	$tbl .= <<<EOD
	
EOD;





	$obj_pdf->writeHTML($tbl, true, false, false, false, '');
	// $height = $obj_pdf->getY();
	//echo $height;
	//$obj_pdf->writeHTML($height, true, false, false, false, '');

	
	// echo $file_path;exit;
	if(!empty($type))
	{
		$obj_pdf->Output($file_path, 'F');
		if($type=="user")
		{
			redirect(base_url().'cmatrix/send_email_for_exits_user/'.$file_name.'/'.$em_id);
		}
		else if($type=="non_user")
		{
			redirect(base_url().'cmatrix/send_email_for_non_exits_user/'.$file_name.'/'.$em_id.'/'.$form_data);
		}
		else if($type == "admin")
		{
			redirect(base_url().'cmatrix/send_email_for_exits_admin/'.$file_name.'/'.$em_id);
		}
	}
	else
	{
		$obj_pdf->Output($file_name, 'I');
	}
	
?>