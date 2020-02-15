<?php
	include("init.php");//Includes all the necessary files

	if($_SERVER['REQUEST_METHOD']=="POST"){
		$messages=array();
		$response=array();

		//extract the datas
		$rollno=trim(strtolower(clean($_POST['rollno'])));
		$image=$_POST['image'];
		$path = "../images/profile_images/".$rollno.".jpg";
		$img_status = file_put_contents($path,base64_decode($image));

		if($img_status){

			$info = getimagesize($path);
			$d=compress($path,$path,20);

			$full_url="https://saar-server.000webhostapp.com/images/profile_images/".$rollno.".jpg";
			$sql="UPDATE alumnus SET img_url='$full_url' WHERE rollno='$rollno'";
			$resilt=query($sql);
	    	$status=206;
	    	$messages["img_url"]=$full_url;

	    }else{
	    	$status=406;
	    	$messages[]="Failed to update profile photo";
		}

		$response['status']=$status;
		$response['messages']=$messages;
		echo json_encode($response);

	}//End of post request

	function compress($source, $destination, $quality) {

		$info = getimagesize($source);

		if ($info['mime'] == 'image/jpeg')
			$image = imagecreatefromjpeg($source);

		elseif ($info['mime'] == 'image/gif')
			$image = imagecreatefromgif($source);

		elseif ($info['mime'] == 'image/png')
			$image = imagecreatefrompng($source);

		imagejpeg($image, $destination, $quality);

		return $destination;
	}