<?php

include('init.php');

  if($_SERVER['REQUEST_METHOD']=="POST"){
  		$messages=array();
		$response=array();

		$post_id = $_POST['post_id'];
		$comment_id = $_POST['comment_id'];

		

		 $sql= "DELETE FROM threads WHERE post_id=$post_id and id=$comment_id";
		 $result = query($sql);
	     if($result){
	     	$response['status']=209;
	        $messages[]="comment deleted succsesfully!";
			}else{
		 	$response['status']=408;
			$messages[]="retry";
			}
	}
        
    
	$response['messages'] = $messages;
     echo json_encode($response);

?>