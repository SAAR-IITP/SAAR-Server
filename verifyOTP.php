<?php
	include("init.php");//Includes all the necessary files

	if($_SERVER['REQUEST_METHOD']=="POST"){
		$messages=array();
		$response=array();

		$rollno=trim(strtolower(clean($_POST['rollno'])));
		$verification_code=clean($_POST['verification_code']);

		$sql="SELECT id, verification_code, active, email FROM alumnus WHERE rollno='$rollno'";
		$result=query($sql);

		if(row_count($result)==1){

			$row=fetch_array($result);
			$database_code=$row['verification_code'];
			$active=$row['active'];
			$email=$row['email'];

			//Checking if user has already activated his account or not
			if($active==1){
				$messages[]="User has already verified his/her account";
				$status=401;
			}else{
				//Matching the verification codes
				if($verification_code==$database_code){

					$sql1="UPDATE alumnus SET active=1 WHERE rollno='$rollno'";
					$result1=query($sql1);
					if(isset($_POST['forgot_password'])){
						$subject="Forgot SAAR-Password";
						$msg="
							<h1>We have succesfully verified you. You can now chnage your password.</h1>
						";
						$messages['msg']="We have succesfully verified you. You can now change your password.";
						$messages['rollno']=$rollno;
						$status=208;
					}else{
						$subject="Activate SAAR Account";
						$msg="
							<h1>Your email id has succesfully been verified. Now you can login</h1>
						";
						$messages[]="You have succesfully verified your account. Now You can login.";
						$status=201;
					}
				send_email($email,$subject,$msg);

				}else{
					$messages[]="Incorrect OTP has been entered.";
					$status=401;
				}
			}			
		}else{
			$messages[]="Following user has not yet filled the register form.";
			$status=401;
		}

		$response['status']=$status;
		$response['messages']=$messages;
		echo json_encode($response);

	}//END OF IF PART OF SERVER REQUEST METHOD