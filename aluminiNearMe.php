<?php

	include ("init.php");
		if($_SERVER['REQUEST_METHOD']=="POST"){

		$messages=array();
		$person=array();
		$response=array();

		$sql = "SELECT * FROM alumnus WHERE 1 ";
		if(isset($_POST["city"])){
			$city = clean($_POST["city"]);
			$sql = $sql."AND `city` LIKE '%".$city."%' ";
		}
		if(isset($_POST["country"])){
			$country = clean($_POST["country"]);
			$sql = $sql."AND `country` LIKE '%".$country."%' ";
		}
		if(isset($_POST["graduation_year"])){
			$graduation_year = clean($_POST["graduation_year"]);
			$sql = $sql. "AND `graduation_year` = '".$graduation_year."' ";
		}
		$result=query($sql);
		if(row_count($result)>0){
			$status = 200;
			while($row = fetch_array($result)) {
				$person['first_name'] = $row['first_name'];
				$person['last_name'] = $row['last_name'];
				$person['img_url'] = $row['img_url'];
				$person['email'] = $row['email'];
				$person['address'] = $row['address'];
				$person['city'] = $row['city'];
				$person['state'] = $row['state'];
				$person['country'] = $row['country'];
				$messages[] = $person;
			}
		}else{
			$status = 400;
			$messages[] = "No Result Found";
		}
		$response["status"] = $status;
		$response["messages"] = $messages;
		echo json_encode($response);
	}

?>