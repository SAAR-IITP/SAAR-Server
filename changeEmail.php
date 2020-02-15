<?php
	include("init.php");

	if($_SERVER['REQUEST_METHOD']=="POST"){

		$response=array();
		$messages=array();

		$old_email=trim(clean($_POST['old_email']));
		$new_email=trim(clean($_POST['new_email']));
		$password=clean($_POST['password']);
		$password=sha1($password);

		$sql= "SELECT id FROM alumnus WHERE email='$old_email' and password='$password'";
		$result=query($sql);

		if(row_count($result)==1){
			if(email_exists($new_email)){
				$messages[]="The new email you entered has already been used by some other person.";
				$status=403;
			}else{
				$row=fetch_array($result);
				$id=$row['id'];

				$verification_code=mt_rand(10001,99999);

				$sql1="UPDATE alumnus SET verification_code='$verification_code', email='$new_email', active=0 WHERE id=$id";
				$result1=query($sql1);

				//Composing the email to be send for changing the email
				$subject="Change your SAAR login Email Id";
				$msg="
					<h4>We have received your request to change email. Enter the following OTP to confirm your email. You can no longeer use your old email.</h4><br><br>
					<h1>$verification_code</h1>
				";
				send_email($new_email,$subject,$msg);

				$status=203;
				$messages[]="We have received your request to change email. Please enter the OTP sent in $new_email";
			}

		}else{
			//Email and password field did not match.
			$messages[]="Email and password field didn't match.";
			$status=403;
		}

		//Sending the response
		$response['status']=$status;
		$response['messages']=$messages;
		echo json_encode($response);

	}//End of if part of post request