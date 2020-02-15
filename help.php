<?php
	include("init.php");

	if($_SERVER['REQUEST_METHOD']=="POST"){

		// Inputs
		$name = trim($_POST['name']);
		$useremail = trim($_POST['useremail']);
		$sub = test_input($_POST['subject']);
		$body = test_input($_POST['body']);

		// Verification
		$error = array();
		if(empty($name)){
			$error[] = "Require name";
		}
		
		if (empty($useremail)) {
			$error[] = "Require email";
		} else {
			if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
				$error[] = "Invalid email format";
			}
		}

		if(empty($body)){
			$error[] = "Require Body";
		}

		// Send
		if(!empty($error)){
			$response['status']=400;
			$response['messages']=$error;
			echo json_encode($response);
		}
		else{
			$email = "vivek_ch17@iitp.ac.in";
			$subject = "Alumni $name wants to say something.";
			$msg = "Alumni Name : $name <br> 
							Alumni Email : $useremail <br><br>
							Subject : $subject <br><br>
							Message, <br>
							$body ";

			if(send_email($email, $subject, $msg, $useremail)){
				$response['status'] = 202;
				$response['message'] = "Successful";
				echo json_encode($response);
			} else {
				$response['status'] = 400;
				$response['message'] = "Unable to send email";
				echo json_encode($response);
			}
		}

	}
