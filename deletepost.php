<?php
 include('init.php');

  if($_SERVER['REQUEST_METHOD']=="POST"){
  		$messages=array();
		$response=array();

		$post_id = $_POST['post_id'];

		$sql = "DELETE FROM posts WHERE id=$post_id";
		$no=0;

		$result = query($sql);

		 if(row_count($result)==1){
		 $no=1;
		 $sql1 = "DELETE FROM threads WHERE post_id=$post_id";
		 $result1 = query($sql1);
        
	     }

	     if($no==1){
	     	$response['status']=209;
	   $messages[]="post deleted succsesfully!";
			

		}
		 if($n0==0){
		 	$response['status']=408;
			$messages[]="retry";
			

	
		}
        
    
	$response['messages'] = $messages;
     echo json_encode($response);

   }
?>