<?php
	include("init.php");//Includes all the necessary files

	if($_SERVER['REQUEST_METHOD']=="POST"){
		$messages=array();
		$response=array();

		$email=trim(clean($_POST['email']));
		$password=clean($_POST['password']);
		$password=sha1($password);


		$sql= "SELECT * FROM alumnus WHERE email='$email' AND password='$password'";
		$result=query($sql);

		if(row_count($result)==1){
			$row=fetch_array($result);
			$active=$row['active'];

			if($active==1){
				
				$access_token=$email.microtime();
				$access_token=sha1($access_token);
				$sql1="UPDATE alumnus SET access_token='$access_token' WHERE email='$email'";
				$sql2="SELECT * FROM yearbook2021 WHERE roll_no='{$row["rollno"]}'";
				$result1=query($sql1);
				$result2=query($sql2);
				
				$messages['ybk__submitted']=(row_count(fetch_array($result2)) == 1);

				//Listing down the response
				$messages['rollno']=$row['rollno'];
				$messages['user_id'] = $row['id'];
				$messages['first_name']=$row['first_name'];
				$messages['last_name']=$row['last_name'];
				$messages['email']=$row['email'];
				$messages['phone']=$row['phone'];
				$messages['fb_link']=$row['fb_link'];
				$messages['linkedin_link']=$row['linkedin_link'];
				$messages['dob']=$row['dob'];
				$messages['graduation_year']=$row['graduation_year'];
				$messages['degree']=$row['degree'];
				$messages['department']=$row['department'];
				$messages['employment_type']=$row['employment_type'];
				$messages['present_employer']=$row['present_employer'];
				$messages['designation']=$row['designation'];
				$messages['address']=$row['address'];
				$messages['country']=$row['country'];
				$messages['state']=$row['state'];
				$messages['city']=$row['city'];
				$messages['achievements']=$row['achievements'];
				$messages['img_url']=$row['img_url'];
				$messages['about']=$row['about'];
				$messages['access_token']=$access_token;

				$response['status']=202;
				$response['messages']=$messages;
			}else{
				$response['status']=402;
				$messages[]="Your account has not yet been verified. Please verify your account.";
			}
		}else{
			$response['status']=402;
			$messages[]="Failed to login. Check your credentials properly.";

		}//End of query failed
		//Sending the final response
		$response['messages']=$messages;
		echo json_encode($response);
	}
