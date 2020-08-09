<?php
 include('init.php');

  if($_SERVER['REQUEST_METHOD']=="POST"){
  		$messages=array();
		$response=array();

		$post_id = $_POST['post_id'];
		$user_id = $_POST['user_id'];
		$access_token_post = $_POST['access_token'];

		$sql = "SELECT * FROM posts WHERE id=$post_id";
		$result = query($sql);
		$row1 = fetch_array($result);
		$user_id_post = $row1['user_id'];

		$sql1 = "SELECT * FROM alumnus WHERE id=$user_id_post";
		$result1 = query($sql1);
		$row = fetch_array($result1);
		$access_token = $row['access_token'];


		if($user_id==$user_id_post && $access_token==$access_token_post)
		{
			$sql = "DELETE FROM posts WHERE id=$post_id";
			$result = query($sql);
			if($result)
			{
				$sql1 = "DELETE FROM threads WHERE post_id=$post_id";
				$result1 = query($sql1);
				$response['status']=209;
				$messages[]="post deleted succsesfully";
			}
			else
			{
				$response['status']=408;
				$messages[]="something Went wrong retry!!";
			}

		}
		else
		{
			$response['status']=409;
			$message[]="unauthorized access";

		}


        
    
	$response['messages'] = $messages;
     echo json_encode($response);

   }
?>

