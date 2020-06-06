<?php
	include("init.php");//Includes all the necessary files
	
	if($_SERVER['REQUEST_METHOD']=="POST"){

		//Initializing the variables
		$errors=array();
		$messages=array();
		$response=array();

		//Extracting datas from the post request
		$rollno=trim(strtolower(clean($_POST['rollno'])));
		$first_name=clean($_POST['first_name']);
		$last_name=clean($_POST['last_name']);
		$email=trim(clean($_POST['email']));
		$phone=clean($_POST['phone']);
		$fb_link=clean($_POST['fb_link']);
		$linkedin_link=clean($_POST['linkedin_link']);
		$password=clean($_POST['password']);
		$confirm_password=clean($_POST['confirm_password']);
		$dob=clean($_POST['dob']);
		$graduation_year=clean($_POST['graduation_year']);
		$degree=clean($_POST['degree']);
		$department=clean($_POST['department']);
		$employment_type=clean($_POST['employment_type']);
		$present_employer=clean($_POST['present_employer']);
		$designation=clean($_POST['designation']);
		$address=clean($_POST['address']);
		$country=clean($_POST['country']);
		$state=clean($_POST['state']);
		$city=clean($_POST['city']);
		$about = clean($_POST['about']);
		$verification_code;

		//Undergoing various data checks
		if(empty($rollno)){
			$errors[]="Roll No cannot be empty.";
		}

		if(empty($first_name)){
			$errors[]="First Name cannot be empty.";
		}

		if(empty($phone)){
			$errors[]="Phone number field cannot be empty.";
		}

		if(empty($graduation_year)){
			$errors[]="Graduation year field cannot be empty.";
		}

		if(empty($degree)){
			$errors[]="Degree field cannot be empty.";
		}

		if(empty($department)){
			$errors[]="Department field cannot be empty.";
		}

		if(strlen($rollno)<8){
			$errors[]="Your Roll No cannot have less then 8 characters.";
		}

		if(strlen($email)<9){
			$errors[]="Your email cannot have less then 9 characters.";
		}

		if(strlen($phone)<10){
			$errors[]="Your phone number cannot have less then 10 digits.";
		}

		if($password!=$confirm_password){
			$errors[]="Your password fields did not match.";
		}

		if(strlen($dob)>10){
			$errors[]="Please enter valid date of birth.";
		}

		if(strlen($graduation_year)!=4){
			$errors[]="Please enter valid date of Graduation year.";
		}

		if(strlen($degree)==0){
			$errors[]="Degree field cannot be empty.";
		}

		if(strlen($department)==0){
			$errors[]="Department field cannot be empty.";
		}

		if(email_exists($email)){
			$errors[]="The email you are trying to use has already been registered.";
		}

		if(rollno_exists($rollno)){
			$errors[]="The roll no you entered has already been registered.";
		}

		//Returning the errors to the request page, if errors are found
		if(!empty($errors)){
			$response['status']=400;
			$response['messages']=$errors;
			echo json_encode($response);
		}else{//Re cleaning the datas
			
			$rollno=escape($rollno);
			$first_name=escape($first_name);
			$last_name=escape($last_name);
			$email=escape($email);
			$phone=escape($phone);
			$fb_link=escape($fb_link);
			$linkedin_link=escape($linkedin_link);
			$dob=escape($dob);
			$graduation_year=escape($graduation_year);
			$degree=escape($degree);
			$department=escape($department);
			$employment_type=escape($employment_type);
			$present_employer=escape($present_employer);
			$designation=escape($designation);
			$address=escape($address);
			$country=escape($country);
			$state=escape($state);
			$city=escape($city);
			$about = escape($about);

			$password=sha1($password);//Encrypted password using sha1 hashing technique
			$verification_code=mt_rand(10001,99999);

			//Composing the email to be send for verification
			$subject="Activate SAAR Account";
			$msg="
				<h1>Thank you $first_name $last_name for registering in SAAR.</h1>
				<br>
				<h2>Please enter the following One Time Password in your OTP confirmation page $verification_code</h2>
				<br>
				<h3>Thank You</h3>
			";

			if(send_email($email,$subject,$msg)){

				$sql="INSERT INTO alumnus(rollno, first_name, last_name, email, phone, fb_link, linkedin_link, password, dob, graduation_year, degree, department, employment_type, present_employer, designation, address, country, state, city, achievements, verification_code, active, about) VALUES('$rollno', '$first_name', '$last_name', '$email', '$phone', '$fb_link', '$linkedin_link', '$password', '$dob', '$graduation_year', '$degree', '$department', '$employment_type', '$present_employer', '$designation', '$address', '$country', '$state', '$city', '$achievements', '$verification_code', 0, '$about')";
				$result=query($sql);

				//Composing the response
				$response['status']=200;
				$messages[]="You have been registered succesfully. Please check your email to get the otp and activate your account.";
				$response['messages']=$messages;
				echo json_encode($response);

			}else{
				$response['status']=400;
				$errors[]="Registration failed becuase we failed to send you the confirmation mail.";
				$response['messages']=$errors;
				echo json_encode($response);
			}//Else part of registration failing during sending email


		}//Else part of Non empty error portion


	}//End of post request method if