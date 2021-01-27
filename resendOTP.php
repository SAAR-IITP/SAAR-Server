<?php
	include("init.php");

	if($_SERVER['REQUEST_METHOD']=="POST"){
		$messages=array();
		$response=array();

		$rollno = strtolower(clean($_POST['rollno']));

		if(rollno_exists($rollno)){
			$sql="SELECT email, active FROM alumnus WHERE rollno='$rollno'";
			$result=query($sql);
			$row=fetch_array($result);
			$email=$row['email'];
			$active=$row['active'];

			if ($active==1){//No need to activate if user is already active and all set ready
				$status=401;
				$messages[]= "Everything is already upto date. You donot need to verify anything now.";

			}else{
				$verification_code= mt_rand(10001,99999);
				$sql1="UPDATE alumnus SET verification_code='$verification_code' WHERE rollno='$rollno'";
				$result1=query($sql1);

				$subject="Activate SAAR-Account";
				$msg="
					<h3>Your OTP is</h3> <h1> $verification_code</h1>
				";
				if(send_email($email,$subject,$msg)){
					$status=201;
					$messages[]= "Succesfully sent the OTP in your email also check spam.";
				}else{
					$status=401;
					$messages[]= "Failed to send OTP in your email.";
				}
			}
		}else{
			$status=401;
			$messages[]= "The Roll No that you have entered has not yet registered.";
		}

		$response['status']=$status;
		$response['messages']=$messages;

		echo json_encode($response);
	}//End of post request
