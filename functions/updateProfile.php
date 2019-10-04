<?php
	include("init.php");//Includes all the necessary files

	if($_SERVER['REQUEST_METHOD']=="POST"){
		$messages=array();
		$response=array();

		//extract the datas
		$rollno=trim(strtolower(clean($_POST['rollno'])));
		$phone=clean($_POST['phone']);
		$employment_type=clean($_POST['employment_type']);
		$present_employer=clean($_POST['present_employer']);
		$designation=clean($_POST['designation']);
		$fb_link=clean($_POST['fb_link']);
		$linkedin_link=clean($_POST['linkedin_link']);
		$address=clean($_POST['address']);
		$country=clean($_POST['country']);
		$state=clean($_POST['state']);
		$city=clean($_POST['city']);
		$achievements=clean($_POST['achievements']);

		$sql="UPDATE alumnus SET phone='$phone', employment_type='$employment_type', present_employer='$present_employer', designation='$designation', fb_link='$fb_link', linkedin_link='$linkedin_link', address= '$address', country='$country', state='$state', city='$city', achievements='$achievements' WHERE rollno='$rollno'";
		$result=query($sql);
		$status=205;
		$messages[]="Profile succesfully updated";

		$response['status']=$status;
		$response['messages']=$messages;
		echo json_encode($response);


	}//End of post request