<?php
	include("init.php");//Includes all the necessary files

	if($_SERVER['REQUEST_METHOD']=="POST"){
		$messages=array();
		$response=array();

		$email=trim(clean($_POST['email']));

		$sql= "SELECT * FROM alumnus WHERE email='$email'";
		$result=query($sql);

		if(row_count($result)==1){
			$row=fetch_array($result);
			$active=$row['active'];

			if($active==1){
				
			$messages['rollno']=$row['rollno'];
			$messages['first_name']=$row['first_name'];
			$messages['last_name']=$row['last_name'];
			$messages['email']=$row['email'];
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

			$response['status']=202;
			$response['messages']=$messages;

			}else{
				$response['status']=402;
				$messages[]="User Account Not verified";
			}
		}else{
			$response['status']=402;
			$messages[]="Failed to find user!";

		}//End of query failed
		//Sending the final response
		$response['messages']=$messages;
		echo json_encode($response);
	}
