<?php

	include ("init.php");
		if($_SERVER['REQUEST_METHOD']=="POST"){

		$messages=array();
		$response=array();

		$sql = "SELECT * FROM alumnus WHERE 1 ";
		if(isset($_POST["branch"])){
			$branch = clean($_POST["branch"]);
			if($branch != "All"){
				$sql = $sql. "AND `department` = '".$branch."' ";
			}
		}
		if(isset($_POST["graduation_year"])){
			$graduation_year = clean($_POST["graduation_year"]);
			$sql = $sql."AND `graduation_year` = '".$graduation_year."' ";
		}
		if(isset($_POST["name"])){
			$name = escape(clean($_POST["name"]));
			$sql = $sql . " AND (`first_name` LIKE '%".$name."%' OR last_name LIKE '%".$name."%') ";
		}
		
		$result=query($sql);
		if(row_count($result)>0){
			$status = 200;
			while($row = fetch_array($result)) {
				$messages[] = $row;
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