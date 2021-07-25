<?php
	include("init.php");//Includes all the necessary files
	
	if($_SERVER['REQUEST_METHOD']=="POST"){

		//Initializing the variables
		$errors=array();
		$messages=array();
		$response=array();

		//Extracting datas from the post request
		$roll_no=trim(strtolower(clean($_POST['roll_no'])));
		$first_name=clean($_POST['first_name']);
		$last_name=clean($_POST['last_name']);
		$email=trim(clean($_POST['email']));
		$phone=clean($_POST['phone']);
		$graduation_year=clean($_POST['graduation_year']);
		$dept=clean($_POST['dept']);
		$dept_other=clean($_POST['dept_other']);
		$quote=clean($_POST['quote']);
		$comments=clean($_POST['comments']);

		//Undergoing various data checks
		if(empty($roll_no)){
			$errors[]="Roll No cannot be empty.";
		}
		if(strlen($roll_no)<8){
			$errors[]="Your Roll No cannot have less then 8 characters.";
		}

		if(empty($first_name)){
			$errors[]="First Name cannot be empty.";
		}
		if(empty($last_name)){
			$errors[]="Last Name cannot be empty.";
		}

		if(strlen($email)<9){
			$errors[]="Your email cannot have less then 9 characters.";
		}

		if(empty($phone)){
			$errors[]="Phone number field cannot be empty.";
		}
		if(strlen($phone)<10){
			$errors[]="Your phone number cannot have less then 10 digits.";
		}

		if(empty($graduation_year)){
			$errors[]="Graduation year field cannot be empty.";
		}
		if(strlen($graduation_year)!=4){
			$errors[]="Please enter valid date of Graduation year.";
		}

		if(empty($dept)){
			$errors[]="Department field cannot be empty.";
		}
		if(strlen($dept)==0){
			$errors[]="Department field cannot be empty.";
		}

		// image files
		foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
			$file_name=$_FILES["files"]["name"][$key];
			$file_tmp=$_FILES["files"]["tmp_name"][$key];
			$ext=pathinfo($file_name,PATHINFO_EXTENSION);

			if(!file_exists("../yearbook2021/" . $file_name)) {
				move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key], "../../yearbook2021/" . "/" . $file_name);
			}
			else {
				$filename=basename($file_name,$ext);
				$newFileName=$filename.time() . "." .$ext;
				move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key], "../../yearbook2021/" . "/" . $newFileName);
			}
		}

		//Returning the errors to the request page, if errors are found
		if(!empty($errors)){
			$response['status']=400;
			$response['messages']=$errors;
			echo json_encode($response);
		}else{
			//Re cleaning the datas

			$roll_no=escape($roll_no);
			$first_name=escape($first_name);
			$last_name=escape($last_name);
			$email=escape($email);
			$phone=escape($phone);
			$graduation_year=escape($graduation_year);
			$dept=escape($dept);
			$dept_other=escape($dept_other);
			$quote=escape($quote);
			$comments=escape($comments);

			$sql="INSERT INTO yearbook2021(roll_no, first_name, last_name, email, phone, graduation_year, dept, dept_other, quote, comments) VALUES('$roll_no', '$first_name', '$last_name', '$email', '$phone', '$graduation_year', '$dept', '$dept_other', '$quote', '$comments')";

			$result=query($sql);

			//Composing the response
			$response['status']=200;
			$messages[]="You have been registered succesfully!";
			$response['messages']=$messages;
			echo json_encode($response);


		}//Else part of Non empty error portion


	}//End of post request method if