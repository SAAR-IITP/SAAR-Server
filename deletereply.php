<?php

include('init.php');

    if($_SERVER['REQUEST_METHOD']=="POST"){
  		$messages=array();
		$response=array();

		$post_id = $_POST['post_id'];
		$comment_id = $_POST['comment_id'];
		$user_id = $_POST['user_id'];
		$access_token_post=$_POST['access_token'];

		$sql = "SELECT * FROM threads WHERE id=$comment_id";
		$result = query($sql);
		$row = fetch_array($result);
		$user_id_post = $row['user_id'];

		$sql = "SELECT * FROM alumnus WHERE id=$user_id_post";
		$result = query($sql);
		$row = fetch_array($result);
		$access_token = $row['access_token'];


		if($user_id==$user_id_post && $access_token==$access_token_post){
            $sql= "DELETE FROM threads WHERE post_id=$post_id and id=$comment_id";
            $result = query($sql);
            if($result){
                $sql = "UPDATE posts SET no_of_comment = no_of_comment-1 WHERE id=$post_id";
                $res4 = query($sql);
                $response['status']=209;
                $messages[]="Comment deleted succsesfully!";
            }else{
                $response['status']=408;
                $messages[]="Retry";
            }
        }else{
			$response['status'] = 409;
			$message[]="Unauthorized access";
		}
        $response['messages'] = $messages;
        echo json_encode($response);
    }

?>
