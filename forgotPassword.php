<?php
	include("init.php");
	if($_SERVER['REQUEST_METHOD']=="POST"){

		$response=array();
		$messages=array();

		$email=trim(clean($_POST['email']));
		$rollno=trim(strtolower(clean($_POST['rollno'])));

		$sql="SELECT id, email FROM alumnus WHERE email='$email' and rollno='$rollno'";
		$result=query($sql);

		if(row_count($result)==1){
			$row=fetch_array($result);

			$email=$row['email'];
			$verification_code=mt_rand(10001,99999);

			//Composing the email to be send for verification
			$subject="Forgot SAAR Account Password";
			$msg="
				<h4>We have initiated the process to reset your password. Please enter the following OTP to confirm your request.</h4><br>
				<h1>$verification_code</h1><br><br>
				<h5>You can no longer login with your old password.</h5>
			";

			if(send_email($email,$subject,$msg)){
				$sql1="UPDATE alumnus SET active=0, verification_code='$verification_code' WHERE email='$email'";
				$result1=query($sql1);

				$status=204;
				$messages[]="We have initiated the process to reset your password. Please enter the following OTP to confirm your request.";

			}else{
				$status=404;
				$messages[]="Failed to send OTP mail. So, we cannot process your password change request.";
			}


		}else{
			$status=404;
			$messages[]="Email and Roll No field didnot match in the database. Please check your details properly.";

		}
		$response['status']=$status;
		$response['messages']=$messages;
		echo json_encode($response);
	}// If part of server request method