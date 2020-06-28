<?php
 include('init.php');

  if($_SERVER['REQUEST_METHOD']=="POST"){
  		$messages=array();
		$response=array();

		$post_id = $_POST['post_id'];

		$sql1 = "SELECT * FROM alumnus WHERE email=$_SESSION['email']";
		$result1 = query($sql);
		$row = fetch_array($result1);
		$access_token = $row['access_token'];

		$sql = "DELETE FROM posts WHERE id=$post_id";
		$no=false;

		$result = query($sql);
        if($access_token==$_SESSION['access_token']){
		 if(row_count($result)==1){
		 $no=true;
		 $sql1 = "DELETE FROM threads WHERE post_id=$post_id";
		 $result1 = query($sql1);
        
	     }

	     if($no){
	     	$response['status']=209;
	   $messages[]="post deleted succsesfully!";
			

		}
		 if($no){
		 	$response['status']=408;
			$messages[]="retry";
			

	
		}
	}else{
		$response['status']=409;
		$message[]="unauthorized access";
	}
        
    
	$response['messages'] = $messages;
     echo json_encode($response);

   }
?>