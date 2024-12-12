<?php
	
	if (!function_exists('pre'))
	{
		function pre(...$data)
		{
			foreach ($data as $all_data) {
				echo "<pre>";
				print_r($all_data);
				echo "</pre>";
			}	
		}
	}

	function assets($path = '')
	{
		return base_url()."public/assets/".$path;
	}

	function uploads($path = '')
	{
		return base_url()."public/uploads/product/".$path;
	}

	if (!function_exists('encrypt_decrypt')) 
	{
		function encrypt_decrypt($action, $data, $secret_key) 
		{
		    $output         = false;
		    $encrypt_method = "AES-256-CBC";
		    $secret_iv      = $secret_key;
		    $key            = hash('sha256', $secret_key);
		    $iv             = substr(hash('sha256', $secret_iv), 0, 16);

		    if ($action == 'encrypt') 
		    {
		        $output = openssl_encrypt($data, $encrypt_method, $key, 0, $iv);
		        $output = base64_encode($output);
		    } 
		    else if ($action == 'decrypt') 
		    {
		        $output = openssl_decrypt(base64_decode($data), $encrypt_method, $key, 0, $iv);
		    }

		    return $output;
		}
	}
	if (!function_exists('send_whatsapp_sms')) {
		function send_whatsapp_sms($mob,$msg){
			$instanceid = "clvxnii52tk14m51ebqgb611b";
			$msg = urlencode($msg);
			// $mob = "8286850973";
        	if(strpos(trim($mob),"+91")===false || strlen(trim($mob))==10){
				$mob = "91".$mob;
			}
			// $url = "https://mrsms.in/api/send?instance_id=6602B1F6EE034&access_token=65feb8a814055&type=text&number=$mob&message=$msg";
			
			$url = "https://enotify.app/api/sendText?token=$instanceid&phone=$mob&message=$msg";
			$output = json_decode(@file_get_contents($url), true);
			return (isset($output['status']) && $output['status'] == 'success') ? ['status' => TRUE, 'data' => TRUE, 'msg' => 'Whatsapp message send successfully'] : ['status' => FALSE, 'data' => FALSE, 'msg' =>''] ;
		}
	}
	if (!function_exists('send_whatsapp_pdf_attachment')) {
		function send_whatsapp_pdf_attachment($mob,$msg="",$path,$file_name=""){
			$instanceid = "clvxnii52tk14m51ebqgb611b";
			$msg = urlencode($msg);
			// $mob = "8286850973";
        	if(strpos(trim($mob),"+91")===false || strlen(trim($mob))==10){
				$mob = "91".$mob;
			}
			$pdf = $path;
			// $url = "https://mrsms.in/api/send?instance_id=6602B1F6EE034&access_token=65feb8a814055&type=media&number=$mob&message=$msg&media_url=$pdf&filename=$file_name";

			$url = "https://enotify.app/api/sendFileWithCaption?token=$instanceid&phone=$mob&link=$pdf&message=$msg";
			$output = json_decode(@file_get_contents($url), true);
			return (isset($output['status']) && $output['status'] == 'success') ? ['status' => TRUE, 'data' => TRUE, 'msg' => 'Whatsapp message send successfully'] : ['status' => FALSE, 'data' => FALSE, 'msg' =>''];
		}
	}
	if (!function_exists('send_mail')) {
		function send_mail($options){
			$CI 	=& get_instance();
			$CI->load->library('email');
			$config['mailtype'] 		= 'html';
			$config['charset'] 			= 'utf-8';
			$config['send_multipart']  	= 'FALSE';

			$CI->email->initialize($config);
			$CI->email->set_newline("\r\n");
			$CI->email->set_crlf( "\r\n" );
			$CI->email->from('noreply@albarkaatadmissions.com', 'ALBARKAAT ADMISSIONS');
			$CI->email->to($options['to']);
			$CI->email->subject($options['subject']);
			$CI->email->message($options['message']);
			if(!empty($options['attachment'])){
				$CI->email->attach($options['attachment']);
			}	
			if(!$CI->email->send()){
				return ['status' => FALSE, 'data' => FALSE, 'msg' => $CI->email->print_debugger()];
			}
			return ['status' => TRUE, 'data' => TRUE, 'msg' => 'Mail send successfully'];
		}
	}
	
?>