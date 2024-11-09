<?php
	// echo "<pre>";print_r($sale_data);
	// echo "<pre>";print_r($sale_trans);exit();
	
	$this->mypdf_class->tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "LITTLE ROSE GIRLS WEAR";

	$file_name = "LITTLE ROSE GIRLS WEAR";
	$file_path = 'public/extra/temp/'.$file_name;

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

	$tbl = "";

$tbl .= <<<EOD

	<table border="0" style="border:1px solid #000;text-align:center;" cellpadding="1">
		<tr>
			<td style="font-size:28px;">LITTLE ROSE GIRLS WEAR</td>
		</tr>
		<tr>
			<td style="font-size:9px; font-weight:normal;">Room No:1/A, Ground Floor, Tambakuwala Bldg, Bhavani Shankar Road, </td>
		</tr>
		<tr>
			<td style="font-size:9px; font-weight:normal;">Opp Masjid Gali, Dadar West . Mumbai - 400028</td>
		</tr>
		<tr>
			<td style="font-size:9px; font-weight:normal;">Mobile No: +91 87675 79339/ 98673 36982 Email: abhishekhsoni47@gmail.com</td>
		</tr>
			<tr>
			<td style="font-size:9px; font-weight:normal;">GST NO: 27AAGFL6891G1ZW   PAN NO: AAGFL6891G</td>
		</tr>
				
		<br/>
		<br/>
		
	</table>
EOD;
$tbl .= <<<EOD
	<table border="1" style="text-align:center;">
		<tr>
			<td style="line-height:2;">TAX INVOICE</td>
		</tr>
	</table>
EOD;

$inv_no = $sale_data[0]['sm_inv_no'];
$inv_date = $sale_data[0]['sm_inv_date'];
$client_name = $sale_data[0]['customer'];
$client_address = $sale_data[0]['cust_address'];
$client_mob = $sale_data[0]['tel_1'];
$client_gst_no = $sale_data[0]['gst_no'];
$client_pan_no = $sale_data[0]['pan'];

$tport_name = $sale_data[0]['tport_name'];
$agent = $sale_data[0]['agent'];
$order_no = $sale_data[0]['sm_order_no'];
$tbl .= <<<EOD
	<table border="0" style="border-top:1px solid #000;border-right:1px solid #000;border-left:1px solid #000;">
		<tr>
			<td style="font-size:10px; border-right:1px solid #000; width:60%;">
				<b style="border-right:1px solid #000;">Name:</b> $client_name<br>
				<b style="border-right:1px solid #000;" rows>Address: $client_address</b><br>
				<b style="border-right:1px solid #000;">PAN No: $client_pan_no</b> <br>
				<b style="border-right:1px solid #000;">GST No: $client_gst_no</b> <br>
				<b style="border-right:1px solid #000;">MOB No: $client_mob</b> <br>
			</td>
			<td style="font-size:8px; width:40%;">
				<b style="font-size: 10px;color:#000000;">Bill No.:$inv_no</b><br/>
				<b style="font-size: 10px;color:#000000;">Date:  $inv_date</b> <br/>
				<b style="font-size: 10px;color:#000000;">Order No.:</b>$order_no<br/>
				<b style="font-size: 10px;border-right:1px solid #000;">Transport:$tport_name</b> <br>
				<b style="font-size: 10px;border-right:1px solid #000;" rows>Agent: $agent</b><br>
			
			</td>
		</tr>
		
	</table>
EOD;

// $tbl .= <<<EOD
// 	<table border="1" height="200">
// 		<tr style="font-size:8px; text-align:center;">
// 			<th>Sr <br> No.</th>
// 			<th>Fabric Name</th>
// 			<th>Design <br> No.</th>
// 			<th>HSN <br> Code</th>
// 			<th>Qty.</th>
// 			<th>Rate</th>
// 			<th>Amt.</th>
// 			<th>Disc</th>
// 			<th>Txable <br> Value</th>
// 			<th>SGST</th>
// 			<th>CGST</th>
// 			<th>IGST</th>
// 			<th>TOTAL</th>
// 		</tr>
// 	</table>
// EOD;

$tbl .= <<<EOD
	<table>
		<tr>
			<td height="370" border="1">
				<table  border="1" cellpadding="3">
					<tr style="font-size:8px; text-align:center;">
						<th style="width:5%;">Sr <br> No.</th>
						<th style="width:13%;" colspan="2">Design No</th>
						<th style="width:8%;">HSN <br> Code</th>
						<th style="width:6%;">Qty.</th>
						<th style="width:6%;">Rate</th>
						<th style="width:6%;">Amt.</th>
						<th style="width:8%;">Disc <br> Amt</th>
						<th style="width:8%;">Taxable <br> Value</th>
						<th colspan="2" style="width:10%;">SGST</th>
						<th colspan="2" style="width:10%;">CGST</th>
						<th colspan="2" style="width:10%;">IGST</th>
						<th style="width:10%;">TOTAL</th>
					</tr>
					<tr style="text-align:center;font-size:10px;font-weight:normal; ">
						<td></td>
						<td colspan="2"></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td style="font-size:8px; width:4%;">%</td>
						<td style="font-size:8px; width:6%;">Amt</td>
						<td style="font-size:8px; width:4%;">%</td>
						<td style="font-size:8px; width:6%;">Amt</td>
						<td style="font-size:8px; width:4%;">%</td>
						<td style="font-size:8px; width:6%;">Amt</td>
						<td></td>
					</tr>
					
EOD;

			foreach($sale_trans as $key => $value) 
			{
				
				$no = $key+1;
				
				$pro_name = $value['dsg_no'];	
				$hsn = $value['dsg_hsn_code'];
				$qty = $value['st_qty'];
				$rate = $value['st_rate'];
				$amt = $value['st_sub_amt'];
				$disc = $value['st_disc_amt'];
				$t_value = $value['st_taxable_amt'];
				$sgst = $value['st_sgst_per'];
				$sgst_amt = $value['st_sgst_per_amt'];
				$cgst = $value['st_cgst_per'];
				$cgst_amt = $value['st_cgst_per_amt'];
				$igst = $value['st_igst_per'];
				$igst_amt = $value['st_igst_per_amt'];
				$final_amt = $value['st_final_total'];				

				$tbl .= <<<EOD
						<tr align="center" style="font-size:8px;font-weight:normal;">
							<td>$no</td>
							<td  colspan="2">$pro_name</td>
							<td>$hsn</td>
							<td>$qty</td>
							<td>$rate</td>
							<td>$amt</td>
							<td>$disc</td>
							<td>$t_value</td>
							<td>$sgst</td>
							<td>$sgst_amt</td>
							<td>$cgst</td>
							<td>$cgst_amt</td>
							<td>$igst</td>
							<td>$igst_amt</td>
							<td>$final_amt</td>
						</tr>
EOD;
		}	

$tbl .= <<<EOD
		
	</table>
	</td>
	</tr>
	</table>
EOD;

	$net_amt = $sale_data[0]['sm_gross_amt'];
	$disc_amt = $sale_data[0]['sm_disc'];
	$b_sgst_amt = $sale_data[0]['sm_sgst_amt'];
	$b_cgst_amt = $sale_data[0]['sm_cgst_amt'];
	$b_igst_amt = $sale_data[0]['sm_igst_amt'];
	// $b_sgst_amt = $sale_data[0]['sm_igst_amt'];
	$b_final_total = $sale_data[0]['sm_net_amt'];
	$word = number_to_word($b_final_total); 

$tbl .= <<<EOD
		<table border="1" style="font-size:8px;" cellpadding="4" >
			<tr>
				 <td colspan="5" rowspan="7">
				 	<br/>
				 	<b style="font-size:10px;">$word</b><br/><br/>
				 	<b style="font-size:8px;">Payment within 30 Days.</b><br/>
				 	<b >We declare that this invoice shows the actual price of goods described </b><br/>
				 	<b>and that all particulars are true and correct</b><br/>

				 	<b style="font-size:8px;">Bank Details</b><br/>
				 	<b style="font-size:8px;">Bank Name : Kotak Mahindra Bank.</b><br/>
				 	<b style="font-size:8px;">Branch : Dr Ambedkar Road, Mum-400014.</b><br/>
				 	<b style="font-size:8px;">A/c No : 1411847215</b><br/>
				 	<b style="font-size:8px;">IFSC : kkbk0001392</b><br/>

				 	</td>
				<td colspan="1" align="right"><b>Sub Total</b></td>
				 <td align="right"><b style="font-size:9px;">$net_amt</b></td>
				
			</tr>
								
			<tr>
				<td colspan="1" align="right"><b>Discount</b></td>
				<td align="right"><b style="font-size:9px;">$disc_amt</b></td>
			</tr>
			<tr>
				<td colspan="1" align="right"><b>SGST</b></td>
				<td align="right"><b style="font-size:9px;">$b_sgst_amt</b></td>
			</tr>
			
			<tr>
				<td colspan="1" align="right"><b>CGST</b></td>
				<td align="right"><b style="font-size:9px;">$b_cgst_amt</b></td>
			</tr>
			<tr>
				<td colspan="1" align="right"><b>IGST</b></td>
				<td align="right"><b style="font-size:9px;">$b_igst_amt</b></td>
			</tr>
			<tr>
				<td colspan="1" align="right"><b>Final total</b></td>
				<td align="right" ><B style="font-size:9px;">$b_final_total</B></td>
				
			</tr>
			<tr>
				<td colspan="2" align="center"><b>For Little Rose Girls Wear</b><br><br><br>
				Authorised Signatory</td>
				
			</tr>
			
			
			
		</table>
EOD;


// $tbl .= <<<EOD
// </table><br /><br />
// EOD;

	$obj_pdf->writeHTML($tbl, true, false, false, false, '');
	$height = $obj_pdf->getY();
	//echo $height;
	//$obj_pdf->writeHTML($height, true, false, false, false, '');

	$obj_pdf->Output($file_name, 'I');
?>