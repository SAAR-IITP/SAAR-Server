<?php
	include("init.php");

	if($_SERVER['REQUEST_METHOD']=="POST"){

		$messages=array();
		$response=array();

		$rollno=trim(strtolower(clean($_POST['rollno'])));
		$old_password=clean($_POST['old_password']);
		$confirm_password=clean($_POST['confirm_password']);
		$new_password=clean($_POST['new_password']);

		$old_password=sha1($old_password);
		$new_password=sha1($new_password);
		$confirm_password=sha1($confirm_password);

		$sql ="SELECT id, password, email FROM alumnus WHERE rollno='$rollno'";
		$result=query($sql);

		if(row_count($result)==1){
			$row=fetch_array($result);
			$password=$row['password'];
			$email=$row['email'];

			//Normal password change
			if(!isset($_POST['forgot_password'])){
				if($password!=$old_password){//password filed didinot match
					$status=407;
					$messages[]="The old password that you entered doesnot match with the database.";
				}else{//Password fields matched
					if($new_password!=$confirm_password){// Password and confirm password did not match
						$status=407;
						$messages[]="The new password fields did not match. Please enter the password field correctly.";
					}else{
						if ($new_password==$old_password){//OLD PASSWORD SAME AS NEW PASSWORD
							$status=407;
							$messages[]="Your old and new passwords are same. Please use a different password.";
						}else{//Ready to reset password

							$sql1="UPDATE alumnus SET password='$new_password' WHERE rollno='$rollno'";
							$result1=query($sql1);

							$subject="Reset SAAR Account Password";
							$msg="
								<h3>Your password has been succefully reseted. Please login with your new password.</h3>
							";
							send_email($email,$subject,$msg);

							$status=207;
							$messages[]="Password has been succefully resetted.";
						}
					}
				}
			}else{//Forgot password change
				if($new_password!=$confirm_password){// Password and confirm password did not match
						$status=407;
						$messages[]="The new password fields did not match. Please enter the password field correctly.";
				}else{
					$sql1="UPDATE alumnus SET password='$new_password' WHERE rollno='$rollno'";
					$result1=query($sql1);

					$subject="Reset SAAR Account Password";
					$msg="
						<h3>Your password has been succefully reseted. Please login with your new password.</h3>
					";
					send_email($email,$subject,$msg);

					$status=207;
					$messages[]="Password has been succefully resetted.";
				}

			}

		}else{
			$status=407;
			$messages[]="You have not yet registered.";
		} // ENd of if part of row count

		$response['status']=$status;
		$response['messages']=$messages;
		echo json_encode($response);

	}//End of server post request method