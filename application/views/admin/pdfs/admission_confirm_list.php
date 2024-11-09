<?php
	// echo"<pre>";print_r($app);exit;
	$this->mypdf_class->tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "admission confirm list";
	$obj_pdf->SetTitle($title);
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetAutoPageBreak(TRUE, 10);
	$obj_pdf->SetFont('helvetica', '', 11);
	$obj_pdf->setFontSubsetting(true);
	//$obj_pdf->RoundedRectXY(0.5,0.5,100,100,10,10,'1111','','','');
	$obj_pdf->AddPage();
	ob_start();
?>


	<table border="1" cellpadding="5">
			<tr>
				<th style="font-family:sans-serif;font-size: 8px;font-weight: bold;" width="7%">SR NO</th>
				<th style="font-family:sans-serif;font-size: 8px;font-weight: bold;" width="9%;">APP NO</th>
				<th style="font-family:sans-serif;font-size: 8px;font-weight: bold;" width="17%;">GR NO</th>
				<th style="font-family:sans-serif;font-size: 8px;font-weight: bold;" width="50%;">CHILD FULL NAME (surname - name - father name)</th>
				<th style="font-family:sans-serif;font-size: 8px;font-weight: bold;" width="5%;">DIV</th>
				<th style="font-family:sans-serif;font-size: 8px;font-weight: bold;" width="12%;">MOBILE NO</th>
			</tr>
			
			<?php 
				if ($data): 
			?>
			<?php 
				foreach ($data as $key => $value):
			?>
			<tr>
				<td style="font-family:sans-serif;font-size: 8px;"><?php echo $key+1?></td>
				<td style="font-family:sans-serif;font-size: 8px;"><?php echo $value['rm_app_no'] ?></td>	
				<td style="font-family:sans-serif;font-size: 8px;"><?php echo $value['rm_child_gr_no'] ?></td>	
				<td style="font-family:sans-serif;font-size: 8px;"><?php echo $value['rm_child_surname'] ." ". $value['rm_child_name'] ." ". $value['rm_child_father_name'] ?></td>	
				<td style="font-family: Helvetica, sans-serif;font-size: 8px;"><?php echo $value['rm_child_division'] ?></td>	
				<td style="font-family:sans-serif;font-size: 8px;"><?php echo $value['rm_parent_mob_no'] ?></td>	
			</tr>
			<?php 
				endforeach;
			?>
			<?php 
				endif; 
			?>
	</table>

<?php
	$content = ob_get_contents();
	ob_end_clean();
	$obj_pdf->writeHTML($content, false, false, false, false, '');
	$obj_pdf->Output('output.pdf', 'I');
?>
