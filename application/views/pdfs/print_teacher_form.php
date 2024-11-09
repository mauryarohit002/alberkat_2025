<?php 
	$this->mypdf_class->tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "APP".$app[0]['rm_app_no'].$app[0]['rm_sr_class'].$app[0]['rm_sd_date'];
	$obj_pdf->SetTitle($title);
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('helvetica', '', 11);
	$obj_pdf->setFontSubsetting(true);
	//$obj_pdf->RoundedRectXY(0.5,0.5,100,100,10,10,'1111','','','');
	$obj_pdf->AddPage();
	ob_start();
?>
<div id="">
			
			<table>
				<tr>
					<td>
						<table style="width:100%;">
							<tr>
								<td style="text-align:center;font-size: 18px;font-weight: bold;font-family:'Times New Roman',arial;">
			                        AL-BARKAAT 
								</td>
							</tr>
							<tr>
								<td style="text-align:center;font-size: 18px;font-weight: bold;font-family:'Times New Roman',arial;text-decoration: underline;">MUHAMMAD ISLAM ENGLISH SCHOOL
								</td>
							</tr>
							<tr>
								<td style="text-align:center;font-family:'Times New Roman',arial;">
			                      Vinoba Bhave Nagar, Kurla (W), Mumbai: 400070
								</td>
							</tr>
						</table>
						<br />
						<br />
						<table style="width:100%;" >
							<tr>
								<td style="text-align:center;">
									<h3>PARITCULARS OF OBSERVATION DURING ADMISSION PROCESS (2016-2017)</h3>
								</td>
							</tr>
						</table>
						<br>
						<br />
						
					
						<table><!-- Main Table -->
							<tr>
								<td>
									<table border="0" cellpadding="5"><!-- Details -->
										
										<tr>
											<td valign="top">
												<table class="print_table" ><!-- First Column -->
													<tr><td width="35%"><b>FORM NO:</b></td><td style="text-align:left;border-bottom: 1px solid #000;" width="65%"><?php echo $app[0]['rm_app_no'];?></td></tr>
										         	<tr><td><b>NAME OF THE FATHER:</b></td><td style="text-align:left;border-bottom: 1px solid #000;"><span id="rm_fp_fr_fname"><?php echo $app[0]['rm_fp_fr_fname'];?></span>&nbsp;<span id="rm_fp_fr_mname"><?php echo $app[0]['rm_fp_fr_mname'];?></span>&nbsp;<span id="rm_fp_fr_lname"><?php echo $app[0]['rm_fp_fr_lname'];?></span></td></tr>
										         	<tr><td><b>EDUCATIONAL QUALIFICATION:</b></td><td style="text-align:left;border-bottom: 1px solid #000;"><span id="rm_fp_fr_quli"><?php echo $app[0]['rm_fp_fr_quli'];?></span></td></tr>
										         	<tr><td><b>NAME OF THE MOTHER:</b></td><td style="text-align:left;border-bottom: 1px solid #000;"><span id="rm_fp_mr_name"><?php echo $app[0]['rm_fp_mr_name'];?></span></td></tr>
										         	<tr><td><b>EDUCATIONAL QUALIFICATION:</b></td><td style="text-align:left;border-bottom: 1px solid #000;"><span id="rm_fp_mr_quli"><?php echo $app[0]['rm_fp_mr_quli'];?></span></td></tr>
										         	
										        </table><!-- First Column End -->
											</td>
											
										</tr>

									</table><!-- Details End -->
									<table border="0" cellpadding="5"><!-- FINANCIAL STATUS Details -->
										
										<tr>
											<td valign="top" width="55%">
												<table class="print_table" ><!-- First Column -->
													<tr><td><b>FINANCIAL STATUS:-</b></td><td> </td></tr>
													<tr><td width="56%"><b>(A)OCCUPATION OF FATHER:</b></td><td width="44%" style="text-align:left;border-bottom: 1px solid #000;">  <?php echo $app[0]['rm_fp_fr_occu'];?></td></tr>
										         	
										         	
										        </table><!-- First Column End -->
											</td>
											<td valign="top" width="45%">
												<table class="print_table" ><!-- First Column -->
													<tr><td></td><td > </td></tr>
													<tr><td width="60%"><b>(B)MONTHLY EARNINGS:</b></td><td width="40%" style="text-align:left;border-bottom: 1px solid #000;">  <?php echo "Rs.".$app[0]['rm_fp_income']."/-";?></td></tr>
										         	
										         	
										        </table><!-- First Column End -->
											</td>
											
										</tr>

									</table><!-- Details End -->
									<br />
									
									<table border="0" cellpadding="5"><!-- child Details -->
										
										<tr>
											<td valign="top">
												<table class="print_table" ><!-- First Column -->
							
													<tr><td width="30%"><b>CHILD'S NAME:</b></td><td width="70%" style="text-align:left;border-bottom: 1px solid #000;">  <?php echo $app[0]['rm_sd_surname']." ".$app[0]['rm_sd_child_name']." ".$app[0]['rm_sd_father_name']." ".$app[0]['rm_sd_mother_name'] ?></td></tr>
										         	
										         	
										        </table><!-- First Column End -->
											</td>
											
										</tr>

									</table><!-- Details End -->
									<br />
									
									<?php if(!empty($st)): ?>
									<table style="width:100%; text-align:left;" border="0" cellpadding="5"><!-- Studet's Sibling Particulars -->
										
										<tr>
											<td style="width:100%; text-align:left;">
												<table style="width:500px; maring:0 auto;" id="reg_sib_table">
											     <tr><td width="30%"><b>SIBLINGS:</b></td><td></td><td></td><td></td><td></td></tr>
												<?php
													$cnt=0;
													if(!empty($st))
													{	
														foreach($st as $v1)
														{
												?>
															<tr>
																<td style="" width="5%"><?php echo $cnt+1;?><?php echo ")" ?></td>
																<td style="text-decoration: underline;" width="20%"><?php echo $st[$cnt]['rm_fp_cs_name'];?></td>
																<td style="" width="10%"><?php echo "Age ".$st[$cnt]['rm_fp_cs_age'];?></td>
																<td style="" width="40%"><?php echo $st[$cnt]['rm_fp_cs_school']." Std in which studying ";?></td>
																<td style="text-decoration: underline;" width="20%"><?php echo $st[$cnt]['rm_fp_cs_class'];?></td>
															</tr>
												<?php
														$cnt++;
														}
													}
												?>
												</table>
											</td>
										</tr>
									</table><!-- Studet's Siblings End -->
									<?php endif; ?>
									<br />
									
									<table border="0" cellpadding="5"><!-- teachers Details -->
										
										<tr>
											<td valign="top">
												<table class="print_table" ><!-- First Column -->
							
													<tr><td width="26%"><b>CLASS TR's FEEDBACK:</b></td><td width="74%" style="text-align:left;border-bottom: 1px solid #000;"> </td></tr>
													<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
													<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
													
													<tr><td style="border-bottom: 1px solid #000;"></td><td  style="text-align:right;border-bottom: 1px solid #000;"><br><br><b>SIGN OF CLASS TR:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
										         	
										         	
										        </table><!-- First Column End -->
											</td>
											
										</tr>

									</table><!-- Details End -->
									<br />
									
									<table border="0" cellpadding="5"><!-- oth Details -->
										
										<tr>
											<td valign="top">
												<table class="print_table" ><!-- First Column -->
							
													<tr><td style="letter-spacing: 0.8px;line-height: 18px;">I undersigned hereby affirm that I will not raise any dispute in respect of school fees being charged from time to time and will pay it regularly. I also confirm that I will not demand any type of concession / grants / freeship in payments of school fees. I shall not raise any objection against the rules and regulations made by the school and will strictly abide by it.</td></tr>
													
										         	
										         	
										        </table><!-- First Column End -->
											</td>
											
										</tr>

									</table><!-- Details End -->
									<br />
									<br />
									<table border="0" cellpadding="5"><!-- signature Details -->
										
										<tr>
											<td valign="top" >
												<table class="print_table" ><!-- First Column -->
													
													<tr><td ><b>FATHER'S SIGNATURE:</b></td><td  style="text-align:left;border-bottom: 1px solid #000;">  </td></tr>
										         	
										         	
										        </table><!-- First Column End -->
											</td>
											<td valign="top">
												<table class="print_table" ><!-- First Column -->
													
													<tr><td ><b>MOTHER'S SIGNATURE:</b></td><td  style="text-align:left;border-bottom: 1px solid #000;"> </td></tr>

										        </table><!-- First Column End -->
											</td>
											
										</tr>

									</table><!-- Details End -->
									<br />
									<br />
									<table border="0" cellpadding="5"><!-- teachers Details -->
										
										<tr>
											<td valign="top">
												<table class="print_table" ><!-- First Column -->
							
													<tr><td width="25%"><b>PRINCIPAL'S REMARK:</b></td><td width="75%" style="text-align:left;border-bottom: 1px solid #000;"> </td></tr>
													<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
													<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
													<tr><td style="border-bottom: 1px solid #000;"><br><br></td><td  style="border-bottom: 1px solid #000;"> </td></tr>
										        </table><!-- First Column End -->
											</td>
											
										</tr>

									</table><!-- Details End -->
									<br />
									<br />
									<table border="0" cellpadding="5"><!-- signature Details -->
										
										<tr>
											<td valign="top" width="40%">
												<table class="print_table" ><!-- First Column -->
													
													<tr><td width="45%"  style="text-align:left;"><b><input type="checkbox" name="a" value="1"  /> <label for="a">ACCEPTED </label> /</b></td><td width="65%"><b><input type="checkbox" name="a" value="1"  /> <label for="a">NOT ACCEPTED </label> </b></td></tr>
										         	
										         	
										        </table><!-- First Column End -->
											</td>
											<td valign="top" width="60%">
												<table class="print_table" ><!-- First Column -->
													
													<tr><td width="20%"><b>REMARK:</b></td><td width="80%" style="text-align:left;border-bottom: 1px solid #000;"> </td></tr>

										        </table><!-- First Column End -->
											</td>
											
										</tr>

									</table><!-- Details End -->
											
								</td>
							</tr>
						</table><!-- Main Table End -->

					
						
					</td>
				</tr>
		</table>

		</div>
<?php
	$content = ob_get_contents();
	ob_end_clean();
	$obj_pdf->writeHTML($content, false, false, false, false, '');
	$obj_pdf->Output('output.pdf', 'I');
?>
