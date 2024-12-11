<?php
	$this->mypdf_class->tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "APP".$app[0]['rm_app_no'].$app[0]['rm_child_class'].$app[0]['rm_reg_date'];
	$obj_pdf->SetTitle($title);
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('helvetica', '', 11);
	$obj_pdf->setFontSubsetting(true);
	$obj_pdf->setPrintHeader(false);
	$obj_pdf->setPrintFooter(false);
	//$obj_pdf->RoundedRectXY(0.5,0.5,100,100,10,10,'1111','','','');

	$obj_pdf->AddPage(1);
	ob_start();

	$style = array(
	    'position' => 'L',
	    'align' => 'L',
	    'stretch' => false,
	    'fitwidth' => true,
	    'cellfitalign' => '',
	    'border' => false,
	    'hpadding' => 'auto',
	    'vpadding' => 'auto',
	    'fgcolor' => array(0,0,0),
	    'bgcolor' => false, //array(255,255,255),
	    'text' => false,
	    'font' => 'helvetica',
	    'fontsize' => 8,
	    'stretchtext' => 4
	);


// CODE I25
$barappno 	= $app[0]['rm_app_no'];

$birth_date = $app[0]['rm_child_birth_date'];
$reg_date 	= $app[0]['rm_reg_date'];
$b_date 	= preg_replace("/-/", "", $birth_date);
$r_date 	= preg_replace("/-/", "", $reg_date);

$barcode 	= $barappno.$b_date;

$params 	= $obj_pdf->serializeTCPDFtagParameters(array($barcode, 'I25', '', '','', 18, 0.8, $style, 'N'));

// $params = $obj_pdf->serializeTCPDFtagParameters(array($barcode, 'C128B', '', '', '', 18, 0.4, $style, 'N'));

?>

<style>
	.pr_data
	{
		border-right: 1px solid #ccc;
		color:#333;
		font-size:8px;
	}
	.headline{
		background-color:#c9766e;color:#fff;

	}
	.pr_title{
		color:#333;
		font-weight:bold;
		font-size:8px;
		border-right: 1px solid #ccc;
	}

	.pr_title_bt{
		color:#333;
		font-weight:bold;
		font-size:8px;
	}

	.tr_even{
		background-color:#fff;
	}
	.tr_odd
	{
		background-color: #f9f9f9;
	}
	.header_title{
		font-weight:normal;
	}
	.t_n_c p{
		font-size:6px;
	}
	.marg{
		margin-top:50px;
	}

</style>
	<table class="marg">
		<tr>
			<td style="width:70%">
				<h5> <span style="text-align:left;color:#333;">C.B.S.E. AFFILIATION NO. 1130375 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="text-align:right;color:#333;"> An ISO : 9001 - 2015 Certified School</span><br/><span style="text-align:left;color:#333;"> SCHOOL CODE : 30252</span></h5>
				<img src="<?php echo assets('images/albarkaat_letter_head2.jpg')?>">
			</td>
			<td style="width:1%"></td>
			<td style="width:15%">
				<img src="<?php echo uploads($app[0]['rm_child_photo'])?>" style="width:132px;height:170px;">
				<br>
				<span style="font-size:7px;text-align:center">CHILD PHOTO</span>
			</td>
			<td style="width:1%"></td>
			<td style="width:15%">
				<img src="<?php echo uploads($app[0]['rm_child_family_photo'])?>" style="width:95px;height:120px;">
				<br>
				<span style="font-size:7px;text-align:center">FAMILY PHOTO</span>
			</td>
		</tr>
	</table>
	<table >
		<tr>
			<td style="width:35%">
				<tcpdf method="write1DBarcode" params="<?php echo $params?>" />
			</td>
			<td>
				<br>
				<h3 class="text-center" style="font-weight:bold;text-decoration:underline;color:#333;">ONLINE APPLICATION FORM</h3>
			</td>
		</tr>
	</table>
	<table cellpadding="6" class="table table-striped">
		<tr class="headline">
			<td class="pr_header" colspan="4"><h4 class="header_title">Registration Details</h4></td>
		</tr>
		<tr class="tr_odd">
			<th class="pr_title" style="">APPLICATION NO.</th>
			<td class="pr_data"><?php echo $app[0]['rm_app_no']?></td>
			<th class="pr_title">DATE</th>
			<td class="pr_data"><?php echo date('d-m-Y',strtotime($app[0]['rm_reg_date']))?></td>
		</tr>

		<tr class="tr_even">
			<th class="pr_title">MOBILE NO.</th>
			<td class="pr_data"><?php echo $app[0]['rm_parent_mob_no']?></td>
			<th class="pr_title">CLASS</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_class']?></td>
		</tr>
		<tr class="headline">
			<td class="pr_header" colspan="4"><h4 class="header_title">Student Details</h4></td>
		</tr>
		<tr class="tr_odd">
			<th class="pr_title">STUDENT NAME</th>
			<td colspan="3" class="pr_data"><?php echo $app[0]['rm_child_surname']." ".$app[0]['rm_child_name']." ".$app[0]['rm_child_father_name']?></td>
		</tr>
		<tr class="tr_even">
			<th class="pr_title">DATE OF BIRTH</th>
			<td class="pr_data"><?php echo date('d-m-Y',strtotime($app[0]['rm_child_birth_date']))?></td>
			<th class="pr_title">PLACE OF BIRTH</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_birth_town']?></td>
		</tr>
		<tr class="tr_odd">
			<th class="pr_title">GENDER</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_gender']?></td>
			<th class="pr_title">MOTHER TONGUE</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_mother_tongue']?></td>
		</tr>
		<tr class="tr_even">
			<th class="pr_title">RELIGION</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_religion']?></td>
			<th class="pr_title">NATIONALITY</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_nationality']?></td>
		</tr>
		<tr class="tr_odd">
			<th class="pr_title">PERMANENT ADDRESS</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_per_add_house_no'].", ".$app[0]['rm_child_per_add_town'].", ".$app[0]['rm_child_per_add_pin_code'].", ".$app[0]['rm_child_per_add_state'].", ".$app[0]['rm_child_per_add_municipality_ward']?></td>
			<th class="pr_title">TEMPORARY ADDERSS</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_temp_add_house_no'].", ".$app[0]['rm_child_temp_add_town'].", ".$app[0]['rm_child_temp_add_pin_code'].", ".$app[0]['rm_child_temp_add_state']?></td>
		</tr>
		<tr class="headline">
			<td class="pr_header" colspan="4"><h4 class="header_title">Family Details</h4></td>
		</tr>
		<tr class="tr_even">
			<th class="pr_title">FATHERS`S NAME</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_father_name']?></td>
			<th class="pr_title">FATHERS'S AGE</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_father_age']?></td>
		</tr>
		<tr class="tr_odd">
			<th class="pr_title">FATHERS`S QUALIFICATION</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_father_qualification']?></td>
			<th class="pr_title">FATHERS`S OCCUPATION</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_father_occupation']?></td>
		</tr>
		<tr class="tr_even">
			<th class="pr_title">MOTHER`S NAME</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_mother_full_name']?></td>
			<th class="pr_title"></th>
			<td class="pr_data"></td>
		</tr>
		<tr class="tr_odd">
			<th class="pr_title">MOTHER`S QUALIFICATION</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_mother_qualification']?></td>
			<th class="pr_title">MOTHER`S OCCUPATION</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_mother_occupation']?></td>
		</tr>
		<tr class="tr_even">
			<th class="pr_title">OFFICE ADDERSS</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_family_office_add'].", ".$app[0]['rm_child_family_office_add_city'].", ".$app[0]['rm_child_family_office_add_pin_code'].", ".$app[0]['rm_child_family_office_add_state']?></td>
			<th class="pr_title">PHONE /MOBILE NO.</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_family_phone_no']." / ".$app[0]['rm_child_family_mob_no']?></td>
		</tr>
		<tr class="tr_odd">
			<th class="pr_title">EMAIL</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_family_email_id']?></td>
			<th class="pr_title">MONTHLY INCOME</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_family_monthly_income']?></td>
		</tr>
		<tr class="headline"><td class="pr_header" colspan="4"><h4 class="header_title">Student Guardian's Details</h4></td></tr>
		<tr class="tr_even">
			<th class="pr_title">GUARDIAN`S NAME</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_guardian_lname']." ".$app[0]['rm_child_guardian_mname']." ".$app[0]['rm_child_guardian_fname']?></td>
			<th class="pr_title">GUARDIAN`S AGE</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_guardian_age']?></td>
		</tr>
		<tr class="tr_odd">
			<th class="pr_title">GUARDIAN`S OCCUPATION</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_guardian_occupation']?></td>
			<th class="pr_title">GUARDIAN`S DESIGNATION</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_guardian_designation']?></td>
		</tr>
		</table>

		<?php

		$content = ob_get_contents();
		ob_end_clean();
		$obj_pdf->writeHTML($content, false, false, false, false, '');
	// $content = ob_get_contents();
	// ob_end_clean();

		$obj_pdf->AddPage(2);
		ob_start();

		$style = array(
	    'position' => 'L',
	    'align' => 'L',
	    'stretch' => false,
	    'fitwidth' => true,
	    'cellfitalign' => '',
	    'border' => false,
	    'hpadding' => 'auto',
	    'vpadding' => 'auto',
	    'fgcolor' => array(0,0,0),
	    'bgcolor' => false, //array(255,255,255),
	    'text' => false,
	    'font' => 'helvetica',
	    'fontsize' => 8,
	    'stretchtext' => 4
	);


	// CODE I25
	$barappno 	= $app[0]['rm_app_no'];

	$birth_date = $app[0]['rm_child_birth_date'];
	$reg_date 	= $app[0]['rm_reg_date'];
	$b_date 	= preg_replace("/-/", "", $birth_date);
	$r_date 	= preg_replace("/-/", "", $reg_date);

	$barcode 	= $barappno.$b_date;
	$params 	= $obj_pdf->serializeTCPDFtagParameters(array($barcode, 'I25', '', '','', 18, 0.8, $style, 'N'));
?>
<style>
	.pr_data
	{
		border-right: 1px solid #ccc;
		color:#333;
		font-size:8px;
	}
	.headline{
		background-color:#c9766e;color:#fff;

	}
	.pr_title{
		color:#333;
		font-weight:bold;
		font-size:8px;
		border-right: 1px solid #ccc;
	}

	.pr_title_bt{
		color:#333;
		font-weight:bold;
		font-size:8px;
	}

	.tr_even{
		background-color:#fff;
	}
	.tr_odd
	{
		background-color: #f9f9f9;
	}
	.header_title{
		font-weight:normal;
	}
	.t_n_c p{
		font-size:6px;
	}
	.marg{
		margin-top:50px;
	}

</style>

		<table >
		<tr>
			<td style="width:35%">
				<tcpdf method="write1DBarcode" params="<?php echo $params?>" />
			</td>

		</tr>
	</table>
		<table cellpadding="6" class="table table-striped">

		<tr class="tr_even">
			<th class="pr_title">RELATION WITH STUDENT</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_guardian_relationship']?></td>
			<th class="pr_title">MOTHER TONGUE</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_guardian_mother_tongue']?></td>
		</tr>
		<tr class="tr_odd">
			<th class="pr_title">OFFICE ADDRESS</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_family_office_add'].", ".$app[0]['rm_child_family_office_add_city'].", ".$app[0]['rm_child_family_office_add_pin_code'].", ".$app[0]['rm_child_family_office_add_state']?></td>
			<th class="pr_title">PHONE /MOBILE NO.</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_family_phone_no']." / ".$app[0]['rm_child_family_mob_no']?></td>
		</tr>
		<tr class="tr_even">
			<th class="pr_title">EMAIL</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_guardian_email_id']?></td>
			<th class="pr_title">MONTHLY INCOME</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_guardian_monthly_income']?></td>
		</tr>
		<tr class="headline"><td class="pr_header" colspan="4"><h4 class="header_title">Student Details</h4></td></tr>
		<tr class="tr_even">
			<th class="pr_title">LANGUAGES SPOKEN AT HOME</th>
			<td class="pr_data"><?php echo $app[0]['rm_child_lng_spkn_at_home_1'].", ".$app[0]['rm_child_lng_spkn_at_home_2'].", ".$app[0]['rm_child_lng_spkn_at_home_3']?></td>
			<th class="pr_title"></th>
			<td class="pr_data"></td>
		</tr>
		<tr class="tr_odd">
			<th class="pr_title">PRE SCHOOL ATTENDED</th>
			<td class="pr_data"><?= $app[0]['rm_child_pre_school_attend']?></td>
			<th class="pr_title">LAST SCHOOL NAME</th>
			<td class="pr_data"><?= $app[0]['rm_child_pre_school_name']?></td>
		</tr>
	</table>



	<table cellpadding="6" class="table table-striped">
		<tr class="headline"><td class="pr_header" colspan="5"><h4 class="header_title">Student Siblings Details</h4></td></tr>
		<tr>
			<th class="pr_title">GR NO.</th>
			<th class="pr_title">NAME</th>
			<th class="pr_title">STD</th>
			<th class="pr_title">DIV</th>
			<th class="pr_title">ROLL NO.</th>
		</tr>
		<?php
			foreach ($st as $key => $value):
		?>
		<tr>
			<td class="pr_data"><?php echo $value['sbltr_gr_no']?></td>
			<td class="pr_data"><?php echo $value['sbltr_sbl_name']?></td>
			<td class="pr_data"><?php echo $value['sbltr_sbl_std']?></td>
			<td class="pr_data"><?php echo $value['sbltr_sbl_div']?></td>
			<td class="pr_data"><?php echo $value['sbltr_sbl_roll_no']?></td>
		</tr>
			<?php endforeach; ?>

	</table>
	<br/><br/>
	<table cellpadding="6" class="table table-striped">
		<tr class="headline"><td class="pr_header" ><h4 class="header_title">Instructions</h4></td></tr>
		<tr>
			<td class="t_n_c">
				<p style="font-size:10px;"><b>a]  </b> Parents seeking admission in <b>Pre-Primary Section</b> are requested to submit the updated Aadhar Card and Birth Certificate of their child issued by the Municipal Corporation (in English only). For admission from <b>Standard I to X,</b> preceding School Leaving Certificate, along with the updated Aadhar Card and Birth Certificate issued by the Municipal Corporation (in English only), must be submitted. The school will not assume responsibility for confirming admission or processing fee refund if admission is pursued without submitting mandatory mentioned documents. </p>
				<p style="font-size:10px;"><b>b]  </b> Al - Barkaat Malik Muhammad Islam English School is a <b>PRIVATE</b>
				and <b>PERMANENTLY UNAIDED</b> institution and does not receive any grant from the government and any other sources.</p>
				<p style="font-size:10px;"><b>c]  </b> As a private unaided institution and given that the school already maintains a reasonable fee structure in comparison to its contemporaries, parents are urged not to request any concession or relaxation in the school fees.</p>
				<p style="font-size:10px;"><b>d]  </b> Parents are requested to settle their monthly fee installments on or before the <b>10th</b> day of every calendar month.</p>
				<p style="font-size:10px;"><b>e]  </b> Fees once paid, are non-refundable/transferable under any circumstances. </p>
				<p style="font-size:10px;"><b>f]  </b> Parents are urged to communicate with the school management and authorities in a respectful language and refrain from using derogatory or unparliamentary language. If
				found to behaving to the contrary, strict action will be taken against the violator.</p>
				<p style="font-size:10px;"><b>g]  </b> Parents are requested to refrain from making defamatory or derogatory remarks about the institution on any search engine or Social Media platforms. In the event of a violation, appropriate action will be initiated against the offender.</p>
			</td>
		</tr>
	</table>

<?php

		$content = ob_get_contents();
		ob_end_clean();
		$obj_pdf->writeHTML($content, false, false, false, false, '');

		$obj_pdf->AddPage(3);
		ob_start();

	$style = array(
	    'position' => 'L',
	    'align' => 'L',
	    'stretch' => false,
	    'fitwidth' => true,
	    'cellfitalign' => '',
	    'border' => false,
	    'hpadding' => 'auto',
	    'vpadding' => 'auto',
	    'fgcolor' => array(0,0,0),
	    'bgcolor' => false, //array(255,255,255),
	    'text' => false,
	    'font' => 'helvetica',
	    'fontsize' => 8,
	    'stretchtext' => 4
	);


	// CODE I25
	$barappno 	= $app[0]['rm_app_no'];

	$birth_date = $app[0]['rm_child_birth_date'];
	$reg_date 	= $app[0]['rm_reg_date'];
	$b_date 	= preg_replace("/-/", "", $birth_date);
	$r_date 	= preg_replace("/-/", "", $reg_date);

	$barcode 	= $barappno.$b_date;
	$params 	= $obj_pdf->serializeTCPDFtagParameters(array($barcode, 'I25', '', '','', 18, 0.8, $style, 'N'));
?>
<style>
	.pr_data
	{
		border-right: 1px solid #ccc;
		color:#333;
		font-size:8px;
	}
	.headline{
		background-color:#c9766e;color:#fff;

	}
	.pr_title{
		color:#333;
		font-weight:bold;
		font-size:8px;
		border-right: 1px solid #ccc;
	}

	.pr_title_bt{
		color:#333;
		font-weight:bold;
		font-size:8px;
	}

	.tr_even{
		background-color:#fff;
	}
	.tr_odd
	{
		background-color: #f9f9f9;
	}
	.header_title{
		font-weight:normal;
	}
	.t_n_c p{
		font-size:6px;
	}
	.marg{
		margin-top:50px;
	}

</style>

		<table>
		<tr>
			<td style="width:35%">
				<tcpdf method="write1DBarcode" params="<?php echo $params?>" />
			</td>

		</tr>
	</table>


	<table>
			<tr>
				<td>
				<p style="font-size:10px;"><b>h]  </b> Parents are requested to abstain themselves from involvement, participation, or association with any group, either offline or online, that is politically/socially motivated and harbors malicious intentions to discredit the institution’s reputation.</p>
				<p style="font-size:10px;"><b>i]  </b> Parents are requested to ensure the punctuality of their children, especially those who employ private or third-party transportation services to drop them off and pick them up from the school.</p>
				<p style="font-size:10px;"><b>j]  </b> As the school does not offer any transportation services, parents are at liberty to either personally drop off and pick up their child from the school or engage the services of any private or third-party transportation at their own risk and cost. The school, will not assume any responsibility in the event of any untoward incident that may occur during transportation.</p>
				<p style="font-size:10px;"><b>k]  </b> The school fees referenced in the Application Form are subject to change from time to time at the discretion of the management without any prior notification. At present the fees structure for new admission for academic year <b>2024-2025</b> of pre-primary section (Nursery/Junior/Senior), is Rs: 55100/- Per Annum, w.e.f. April -2024 to March-2025.</p>
				<p style="font-size:10px;"><b>l] </b> The school management is at liberty to add to, amend, vary, alter and/or rescind any of the instructions mentioned hereinabove.</p>
			</td>
		</tr>
	</table>
	<br><br>
	<br/><br/>
	<table cellpadding="6" class="table table-striped">
		<tr class="headline"><td class="pr_header"><h4 class="header_title">Under Taking Cum Declaration</h4></td></tr>
		<tr>
			<td class="t_n_c">
				<p style="font-size:10px;"> &nbsp; &nbsp;  &nbsp; I, the undersigned Parents/Guardian of Master/ Miss <b><?php echo $app[0]['rm_child_surname']." ".$app[0]['rm_child_name']." ".$app[0]['rm_child_father_name']?> </b>, seeking admission in <b><?php echo $app[0]['rm_child_class']; ?></b> for the academic year 2024-25 do hereby solemnly declare & undertake as under:	</p>	
				<p style="font-size:10px;"><b>a]  </b> I have read all the applicable Rules and Regulations, Instructions, Guidelines and Eligibility Criteria related to admission. </p>
			</td>
		</tr>
		<tr>
			<td class="t_n_c">
				<p style="font-size:10px;"><b>b]  </b> The information filled in by me in this form is complete, correct and true to the best of my knowledge & belief. I will personally be responsible and liable for any discrepancy arising out of any incorrect, incomplete documentation, or details filled by me in the admission form.</p>
				<p style="font-size:10px;"><b>c]  </b> I understand that if admission to my child is delayed, denied or cancelled, on account of any reason, including the availability of seats & submission of incorrect information and/or documents, then I shall not hold the school or its staff responsible for the consequences thereof, and/or as a result, the school is liable for any monetary or other consequences.
				I undertake to indemnify the school without any demur.</p>
				<p style="font-size:10px;"><b>d]  </b> I understand that the acceptance of the Admission Form does not guarantee admission. Further, even after acceptance of the payment of fees, admission to my child is
				PROVISIONAL, subject to approval by the School Management/Authorities.</p>
				<p style="font-size:10px;"><b>e]  </b> I understand and am satisfied that the school Management is very cautious about the safety and welfare of children. Despite best efforts, all possible precautions, and safety measures taken by the school, any mishappening may occur due to any factors beyond the control of the school, I shall not blame the school Management in any manner, and I shall have no claim whatsoever.
				</p>
				<p style="font-size:10px;"><b>f]  </b> I hereby undertake that the school will not be liable for any damages or charges on account of any misfortune, or injuries which may be sustained by my child at any time while taking part in any curricular, or extracurricular activities, or while participating in sports, or during travelling or any other normal activities, or by contracting any illness or disease inside or outside the school premises. All expenses that may be incurred on the treatment of such injuries will be borne by me.</p>
			</td>
		</tr>
	</table>		

<?php

		$content = ob_get_contents();
		ob_end_clean();
		$obj_pdf->writeHTML($content, false, false, false, false, '');

		$obj_pdf->AddPage(4);
		ob_start();

		$style = array(
	    'position' => 'L',
	    'align' => 'L',
	    'stretch' => false,
	    'fitwidth' => true,
	    'cellfitalign' => '',
	    'border' => false,
	    'hpadding' => 'auto',
	    'vpadding' => 'auto',
	    'fgcolor' => array(0,0,0),
	    'bgcolor' => false, //array(255,255,255),
	    'text' => false,
	    'font' => 'helvetica',
	    'fontsize' => 8,
	    'stretchtext' => 4
	);


	// CODE I25
	$barappno 	= $app[0]['rm_app_no'];

	$birth_date = $app[0]['rm_child_birth_date'];
	$reg_date 	= $app[0]['rm_reg_date'];
	$b_date 	= preg_replace("/-/", "", $birth_date);
	$r_date 	= preg_replace("/-/", "", $reg_date);

	$barcode 	= $barappno.$b_date;
	$params 	= $obj_pdf->serializeTCPDFtagParameters(array($barcode, 'I25', '', '','', 18, 0.8, $style, 'N'));
?>
<style>
	.pr_data
	{
		border-right: 1px solid #ccc;
		color:#333;
		font-size:8px;
	}
	.headline{
		background-color:#c9766e;color:#fff;

	}
	.pr_title{
		color:#333;
		font-weight:bold;
		font-size:8px;
		border-right: 1px solid #ccc;
	}

	.pr_title_bt{
		color:#333;
		font-weight:bold;
		font-size:8px;
	}

	.tr_even{
		background-color:#fff;
	}
	.tr_odd
	{
		background-color: #f9f9f9;
	}
	.header_title{
		font-weight:normal;
	}
	.t_n_c p{
		font-size:6px;
	}
	.marg{
		margin-top:50px;
	}

</style>
	<table>
		<tr>
			<td style="width:35%">
				<tcpdf method="write1DBarcode" params="<?php echo $params?>" />
			</td>
		</tr>
	</table>
	<br>
	<table cellpadding="6" class="table table-striped">	
		<tr>
			<td class="t_n_c">	
				<p style="font-size:10px;"><b>g]  </b> I comprehend that the school may capture videos and Photographs of myself and of my child for inclusion in the School Prospectus, Brochures, School Website, Social Media Channels, and other multipurpose educational needs as and when required. I undertake to give My Consent/No Objection to using mine and my child’s videos and Photographs, and I affirm that I shall not demand any monetary benefit or compensation in return.</p>
				<p style="font-size:10px;"><b>h]  </b> I undertake to abide by the decisions and actions taken by the school authorities from time to time in maintaining discipline, and the decision of the authorities shall be final.</p>
				<p style="font-size:10px;"><b>i]  </b> I authorize the school to take disciplinary action in the interest of my child in case he/she does not abide by the rules & regulations mentioned in the school policy. I undertake to accept the decision in this regard.</p>
				<p style="font-size:10px;"><b>j]  </b> I understand that Al - Barkaat Malik Muhammad Islam English School is a private unaided institution. Nevertheless, I voluntarily choose to enroll my child in the school.</p>
				<p style="font-size:10px;"><b>k]  </b> I declare and undertake to abstain from challenging, either personally or on behalf of any other parent and vice versa, the existing and future fee structure of the school.</p>
				<p style="font-size:10px;"><b>l]  </b> I undertake to pay the school fees regularly within the stipulated date as mentioned by the school authority. Failing this, I understand that it would result in additional late fines, and penalties, along with strict actions as set out in school norms.</p>
				<p style="font-size:10px;"><b>m]  </b> I undertake that I shall not initiate any legal or other proceedings against the school authorities and its staff for any mishappening or disciplinary action taken by the school.</p>
				<p style="font-size:10px;"><b>n]  </b> I understand and acknowledge that this Application Form may be presented to the concerned authorities for necessary purposes as and when required. I hereby declare that
				I have no disputes or objections regarding the fees, instructions mentioned hereinabove, and rules and regulations of the institution.</p>
				<p style="font-size:10px;"><b>o]  </b> I undertake to abide by the Rules and Regulations made thereunder, as per the school policy, and shall not act contrary there to.</p>
				<p style="font-size:10px;"><b>p]  </b> I hereby declare that I have carefully read and understood the contents stated hereunder, and I voluntarily affix my signature without any fear or favor, coercion or undue influence from anybody.</p>
				<p style="font-size:10px;"><b>q]  </b> I hereby grant my CONSENT, UNDERTAKING AND EXPRESS NO OBJECTION,
				authorizing the School Management to proceed with the admission procedure.</p>
			</td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td>
                <span class="tnc">
                	<?php
                		if ($app[0]['rm_app_status'] == 3 && $app[0]['rm_tnc']==0):
                	?>
                	<img src="<?php echo assets('images/checkboxempty.png')?>">
                	<?php
                		else:
                	?>
                	<img src="<?php echo assets('images/check-box.png')?>">
                	<?php
                		endif;
                	 ?>

                	<a href="#" style="font-size: 18px;color: #d04747;font-weight: bold;margin-left: 10px;"> I have read and agreed to the above terms & condition</a></span>
                	<p style="font-size:12px;"> &nbsp;  &nbsp; The Terms & Conditions accepted On : <?php echo (!empty($app[0]['rm_tnc_datetime']) && $app[0]['rm_tnc_datetime']!='0000-00-00 00:00:00' && $app[0]['rm_tnc_datetime']!='1970-01-01 05:30:00')? date('d-m-Y',strtotime($app[0]['rm_tnc_datetime'])). ' at '.date('H:i:s',strtotime($app[0]['rm_tnc_datetime'])):''; ?></p>
			</td>
		</tr>

	</table>
	<br>
	<br>
	<br>
	<br>
	<table>
		<tr>
			<td width="20%" class="pr_title_bt" ><b>FATHER'S SIGNATURE :</b></td>
			<td width="20%" style="text-align:left;border-bottom: 1px solid #000;"></td>
			<td width="41%" class="pr_title_bt" style="text-align: right;"><b>MOTHER'S SIGNATURE :</b></td>
			<td width="20%" style="text-align:left;border-bottom: 1px solid #000;"> </td>

			<!-- <td width="50%" style="font-weight: bold;">Father's Signature</td>
			<td width="50%" style="text-align: right;font-weight: bold;">Mother's Signature</td> -->
		</tr>
	</table>
	<?php

		$content = ob_get_contents();
		ob_end_clean();
		$obj_pdf->writeHTML($content, false, false, false, false, '');

		$obj_pdf->AddPage(4);
		ob_start();

		$style = array(
	    'position' => 'L',
	    'align' => 'L',
	    'stretch' => false,
	    'fitwidth' => true,
	    'cellfitalign' => '',
	    'border' => false,
	    'hpadding' => 'auto',
	    'vpadding' => 'auto',
	    'fgcolor' => array(0,0,0),
	    'bgcolor' => false, //array(255,255,255),
	    'text' => false,
	    'font' => 'helvetica',
	    'fontsize' => 8,
	    'stretchtext' => 4
	);


	// CODE I25
	$barappno 	= $app[0]['rm_app_no'];

	$birth_date = $app[0]['rm_child_birth_date'];
	$reg_date 	= $app[0]['rm_reg_date'];
	$b_date 	= preg_replace("/-/", "", $birth_date);
	$r_date 	= preg_replace("/-/", "", $reg_date);

	$barcode 	= $barappno.$b_date;
	$params 	= $obj_pdf->serializeTCPDFtagParameters(array($barcode, 'I25', '', '','', 18, 0.8, $style, 'N'));
?>
<style>
	.pr_data
	{
		border-right: 1px solid #ccc;
		color:#333;
		font-size:8px;
	}
	.headline{
		background-color:#c9766e;color:#fff;

	}
	.pr_title{
		color:#333;
		font-weight:bold;
		font-size:8px;
		border-right: 1px solid #ccc;
	}

	.pr_title_bt{
		color:#333;
		font-weight:bold;
		font-size:8px;
	}

	.tr_even{
		background-color:#fff;
	}
	.tr_odd
	{
		background-color: #f9f9f9;
	}
	.header_title{
		font-weight:normal;
	}
	.t_n_c p{
		font-size:6px;
	}
	.marg{
		margin-top:50px;
	}

</style>
	<table>
		<tr>
			<td style="width:35%">
				<tcpdf method="write1DBarcode" params="<?php echo $params?>" />
			</td>
		</tr>
	</table>
	<br>
	<table cellpadding="6" class="table table-striped">
		<tr class="headline"><td class="pr_header" colspan="5"><h4 class="header_title">PAYMENT DETAILS</h4></td></tr>
		<tr>
			<th class="pr_title">APP ID.</th>
			<th class="pr_title">NAME</th>
			<th class="pr_title">CODE</th>
			<th class="pr_title">AMOUNT</th>
			<th class="pr_title">PAYMENT STATUS</th>
		</tr>
		<?php
			foreach ($pay_data as $key => $value):
				switch ($value['vpc_trans_resp_code']) {
			        case "0" : $result = "Transaction Successful"; break;
			        case "?" : $result = "Transaction status is unknown"; break;
			        case "E" : $result = "Referred"; break;
			        case "1" : $result = "Transaction Declined"; break;
			        case "2" : $result = "Bank Declined Transaction"; break;
			        case "3" : $result = "No Reply from Bank"; break;
			        case "4" : $result = "Expired Card"; break;
			        case "5" : $result = "Insufficient funds"; break;
			        case "6" : $result = "Error Communicating with Bank"; break;
			        case "7" : $result = "Payment Server detected an error"; break;
			        case "8" : $result = "Transaction Type Not Supported"; break;
			        case "9" : $result = "Bank declined transaction (Do not contact Bank)"; break;
			        case "A" : $result = "Transaction Aborted"; break;
			        case "B" : $result = "Fraud Risk Blocked"; break;
					case "C" : $result = "Transaction Cancelled"; break;
			        case "D" : $result = "Deferred transaction has been received and is awaiting processing"; break;
			        case "E" : $result = "Transaction Declined - Refer to card issuer"; break;
					case "F" : $result = "3D Secure Authentication failed"; break;
			        case "I" : $result = "Card Security Code verification failed"; break;
			        case "L" : $result = "Shopping Transaction Locked (Please try the transaction again later)"; break;
			        case "M" : $result = "Transaction Submitted (No response from acquirer)"; break;
					case "N" : $result = "Cardholder is not enrolled in Authentication scheme"; break;
			        case "P" : $result = "Transaction has been received by the Payment Adaptor and is being processed"; break;
			        case "R" : $result = "Transaction was not processed - Reached limit of retry attempts allowed"; break;
			        case "S" : $result = "Duplicate SessionID (Amex Only)"; break;
			        case "T" : $result = "Address Verification Failed"; break;
			        case "U" : $result = "Card Security Code Failed"; break;
			        case "V" : $result = "Address Verification and Card Security Code Failed"; break;
			        default  : $result = "Unable to be determined";
			    }
		?>
		<tr>
			<td class="pr_data"><?php echo $value['order_info']?></td>
			<td class="pr_data"><?php echo $value['rm_child_surname'].' '.$value['rm_child_name'].' '.$value['rm_child_father_name']?></td>
			<td class="pr_data"><?php echo $value['unique_barcode']?></td>
			<td class="pr_data"><?php echo $value['trans_amt']?></td>
			<td class="pr_data"><?php echo $result ?></td>
		</tr>
			<?php endforeach; ?>

	</table>
	<br>
	<br>
	<br>
	<table cellspacing="5">
		<tr>
			<td style="width:27%;text-align:center;">FATHER PHOTO</td>
			<td style="width:10%;"></td>
			<td style="width:27%;text-align:center;">MOTHER PHOTO</td>
			<td style="width:9%;"></td>
			<td style="width:27%;text-align:center;">CHILD PHOTO</td>
		</tr>
		<tr>
			<td style="width:27%;border:1px solid #000;height:160px;text-align:center;">
				<br><br><br><br><br><br>FATHER PHOTO
			</td>
			<td style="width:10%;"></td>
			<td style="width:27%;border:1px solid #000;height:160px;text-align:center;">
				<br><br><br><br><br><br>MOTHER PHOTO
			</td>
			<td style="width:9%;"></td>
			<td style="width:27%;border:1px solid #000;height:160px;text-align:center;">
				<br><br><br><br><br><br>CHILD PHOTO
			</td>
		</tr>
	</table>
	<br>
	<br>
	<table>
		<tr>
			<td>
				<br>
				<h3 class="text-center" style="font-weight:bold;text-decoration:underline;color:#333;text-align: center;">FOR OFFICE USE ONLY</h3>
				<br>
			</td>
		</tr>
		<tr>
			<td width="19%" class="pr_title_bt"><b>VERIFICATION DATE:</b></td><td width="25%" style="text-align:left;border-bottom: 1px solid #000;"> </td>
			<td width="12%" class="pr_title_bt"></td>
			<td width="19%" class="pr_title_bt" style="border: none;"><b>VERIFICATION TIME:</b></td><td width="25%" style="text-align:left;border-bottom: 1px solid #000;"> </td>
		</tr>
	</table>
	<br>
	<br>
	<table border="1" cellpadding="5">
		<tr>
			<td colspan="10">Detail's of Child's Siblings (Studying in this institution)</td>
		</tr>
		<tr>
			<td width="6%;" class="pr_title_bt">SR NO.</td>
			<td width="31%" class="pr_title_bt">NAME</td>
			<td width="8%" class="pr_title_bt">STD/<br/>DIV</td>
			<td width="8%;" class="pr_title_bt">GR NO</td>
			<td width="31%" class="pr_title_bt">ACADEMIC PROGRESS</td>
			<td width="16%" class="pr_title_bt">FEES DETAILS</td>
		</tr>
		<tr>
			<td><br/><br/><br/><br/><br/></td>
			<td><br/><br/><br/><br/><br/></td>
			<td><br/><br/><br/><br/><br/></td>
			<td><br/><br/><br/><br/><br/></td>
			<td><br/><br/><br/><br/><br/></td>
			<td><br/><br/><br/><br/><br/></td>
		</tr>
		<tr>
			<td><br/><br/><br/><br/><br/></td>
			<td><br/><br/><br/><br/><br/></td>
			<td><br/><br/><br/><br/><br/></td>
			<td><br/><br/><br/><br/><br/></td>
			<td><br/><br/><br/><br/><br/></td>
			<td><br/><br/><br/><br/><br/></td>
		</tr>
	</table>
	
	<?php

		$content = ob_get_contents();
		ob_end_clean();
		$obj_pdf->writeHTML($content, false, false, false, false, '');

		$obj_pdf->AddPage(4);
		ob_start();

		$style = array(
	    'position' => 'L',
	    'align' => 'L',
	    'stretch' => false,
	    'fitwidth' => true,
	    'cellfitalign' => '',
	    'border' => false,
	    'hpadding' => 'auto',
	    'vpadding' => 'auto',
	    'fgcolor' => array(0,0,0),
	    'bgcolor' => false, //array(255,255,255),
	    'text' => false,
	    'font' => 'helvetica',
	    'fontsize' => 8,
	    'stretchtext' => 4
	);


	// CODE I25
	$barappno 	= $app[0]['rm_app_no'];

	$birth_date = $app[0]['rm_child_birth_date'];
	$reg_date 	= $app[0]['rm_reg_date'];
	$b_date 	= preg_replace("/-/", "", $birth_date);
	$r_date 	= preg_replace("/-/", "", $reg_date);

	$barcode 	= $barappno.$b_date;
	$params 	= $obj_pdf->serializeTCPDFtagParameters(array($barcode, 'I25', '', '','', 18, 0.8, $style, 'N'));
?>
<style>
	.pr_data
	{
		border-right: 1px solid #ccc;
		color:#333;
		font-size:8px;
	}
	.headline{
		background-color:#c9766e;color:#fff;

	}
	.pr_title{
		color:#333;
		font-weight:bold;
		font-size:8px;
		border-right: 1px solid #ccc;
	}

	.pr_title_bt{
		color:#333;
		font-weight:bold;
		font-size:8px;
	}

	.tr_even{
		background-color:#fff;
	}
	.tr_odd
	{
		background-color: #f9f9f9;
	}
	.header_title{
		font-weight:normal;
	}
	.t_n_c p{
		font-size:6px;
	}
	.marg{
		margin-top:50px;
	}

</style>
	<table>
		<tr>
			<td style="width:35%">
				<tcpdf method="write1DBarcode" params="<?php echo $params?>" />
			</td>
		</tr>
	</table>
	<br>
	<br>
	<table>
		<tr><td width="33%" class="pr_title_bt"><b>APPLICANT'S OBSERVATION REPORT :</b></td><td width="67%" style="text-align:left;border-bottom: 1px solid #000;"> </td></tr>
		<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
		<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
		<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
	</table>
	<br>
	<br>
	<br>
	<table>
		<tr><td width="30%" class="pr_title_bt"><b>PARENT'S OBSERVATION REPORT :</b></td><td width="70%" style="text-align:left;border-bottom: 1px solid #000;"> </td></tr>
		<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
		<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
		<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
	</table>
	<br>
	<br>
	<br>
	<table>
		<tr><td width="22%" class="pr_title_bt"><b>PRINCIPAL'S REMARK :</b></td><td width="78%" style="text-align:left;border-bottom: 1px solid #000;"> </td></tr>
		<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
	</table>
	<br>
	<br>
	<br>
	<table>
		<tr><td width="24%" class="pr_title_bt"><b>ADMINISTRATION REPORT :</b></td><td width="76%" style="text-align:left;border-bottom: 1px solid #000;"> </td></tr>
		<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
	</table>
	<br>
	<br>
	<br>
	<table>
		<tr><td width="32%" class="pr_title_bt"><b>DOCUMENT'S VERIFIED AND COLLECTED :</b></td><td width="68%" style="text-align:left;border-bottom: 1px solid #000;"> </td></tr>
		<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
	</table>
	<br>
	<br>
	<br>
	<table>
		<tr><td width="20%" class="pr_title_bt"><b>DOCUMENT'S PENDING :</b></td><td width="80%" style="text-align:left;border-bottom: 1px solid #000;"> </td></tr>
		<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
	</table>
	<br>
	<br>
	<br>
	<table>
		<tr>
			<td width="20%">
                <span class="tnc">
                	<img src="<?php echo assets('images/checkboxempty.png')?>">
                	<span class="pr_title_bt" style="font-size: 11px;">SELECTED</span>
               	</span>
			</td>
			<td width="23%">
                <span class="tnc">
                	<img src="<?php echo assets('images/checkboxempty.png')?>">
                	<span class="pr_title_bt" style="font-size: 11px;">REJECTED</span>
               	</span>
			</td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	<br>
	<table>
		<tr>
			<td>
				<br>
				<span class="pr_title_bt" style="font-size: 11px;">PLACE:MUMBAI</span>
				<br/>
				<span class="pr_title_bt" style="font-size: 11px;">TIME: <?php echo date('h:i A')?></span>
			</td>
			<td>
				<br>
				<span class="pr_title_bt" style="font-size: 11px;text-align: center;">PRINCIPAL'S SIGNATURE</span>
			</td>
			<td>
				<br>
				<span class="pr_title_bt" style="font-size: 11px;text-align: right;">SCHOOL SEAL STAMP</span>
			</td>
		</tr>
	</table>

<?php
	$content = ob_get_contents();
	ob_end_clean();
	$obj_pdf->writeHTML($content, false, false, false, false, '');
	$obj_pdf->Output('application.pdf', 'I');
?>
