<?php 
	$config['role'] = array("1" => "PROJECT MANAGER", "2" => "USER");

	$config['duplicate'] = array("1" => "Event Input", "2" => "Score Events","3" => "Scenario Planning", "4" => "Scorings Scenario");

	$config['department'] = array("0" => "None", "1" => "Departmet 1", "2" => "Departmet 2", "3" => "Departmet 3", "4" => "Departmet 4");

	$config['tier'] = array("1" => "PREMIUM", "2" => "MID", "3" => "LOW");

	$config['user_status'] = array("1" => "Active", "0" => "Inactive");

	$config['month'] = array(

			'01' => "Jan",
			'02' => "Feb",
			'03' => "Mar",
			'04' => "Apr",
			'05' => "May",
			'06' => "Jun",
			'07' => "Jul",
			'08' => "Aug",
			'09' => "Sep",
			'10' => "Oct",
			'11' => "Nov",
			'12' => "Dec"
		);

		$config['pagination'] = array(

			'query_string_segment' =>  'offset',
            'page_query_string'    =>  true,
            'total_rows'           =>  60,
            'per_page'             =>  10,
            'full_tag_open'        =>  '<nav><ul class="pagination pull-right">',
            'full_tag_close'       =>  '</ul></nav>',
            'prev_link'            =>  '<span aria-hidden="true">&laquo;</span>',
            'prev_tag_open'        =>  '<li>',
            'prev_tag_close'       =>  '</li>',
            'first_link'           =>  'First',    
            'first_tag_open'       =>  '<li>',
            'first_tag_close'      =>  '</li>',
            'last_link'            =>  'Last',
            'last_tag_open'        =>  '<li>',
            'last_tag_close'       =>  '</li>',
            'next_link'            =>  '<span aria-hidden="true">&raquo;</span>',
            'next_tag_open'        =>  '<li>',
            'next_tag_close'       =>  '</li>',
            'num_tag_open'         =>  '<li>',
            'num_tag_close'        =>  '</li>',
            'cur_tag_open'         =>  '<li class="active"><a style="background: #c9766e;border: 1px solid;">',
            'cur_tag_close'        =>  '</a></li>',
	);

	$config['app_status'] = array(
		'0' => 'Pending',
		'1' => 'Incomplete Application',
		'2' => 'Photo Not Proper',
		'3' => 'Payment Not Done',
		'4' => 'Application Print Done',
		'5' => 'Verification Schedule',
		'6' => 'Application Rejected',
		'7' => 'Admission Confirm',
		'8' => 'Provisional Selection',
		'9' => 'Absent For Interview',
		'12' => 'Test Exam'
	);

	$config['app_status_search'] = array(
		
		'10' => 'All',
		'0' => 'Pending',
		'1' => 'Incomplete Application',
		'2' => 'Photo Not Proper',
		'3' => 'Payment Not Done',
		'4' => 'Application Print Done',
		'5' => 'Verification Schedule',
		'6' => 'Application Rejected',
		'7' => 'Admission Confirm',
		'8' => 'Provisional Selection',
		'9' => 'Absent For Interview',
		'12' => 'Test Exam',
		'11' => 'Sibling',
	);

	$config['app_search'] = array(
		"" => "Select Option",
		"rm_app_no" 				=> "Application No",
		"rm_reg_date" 				=> "Date of Submission",
		"rm_child_name" 			=> "Child Name", 
		"rm_child_father_name" 		=> "Father Name",
		"rm_child_mother_name" 		=> "Mother Name",
		"rm_child_guardian_fname" 	=> "Gurdian Name",
		"rm_child_class" 			=> "Standard",
		"rm_parent_mob_no" 			=> "Mobile No",
		"rm_child_gender" 			=> "Gender"
	);	

	$config['division'] = array(
		"0" => "Select Division",
		"A" => "A",
		"B" => "B",
		"C" => "C", 
		"D" => "D",
		"E" => "E"
	);	

?>