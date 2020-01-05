<?php 
    include('init.php');
    if($_SERVER['REQUEST_METHOD']=="POST"){

		//Initializing the variables
		$response=array();

		$user_id = clean($_POST['user_id']);
		$id = clean($_POST['id']);
		$cat_id = clean($_POST['cat_id']);
		$title = clean($_POST['title']);
		$body = clean($_POST['body']);
		if(isset($_POST['images']))
			$images = $_POST['images'];
    else $images = serialize(array());
		
		if(empty($title)){
			$response['status'] = 402;
			$response['message'] = "Title cannot be empty";
		}
		else {
			$sql = "SELECT `id` FROM `posts` WHERE id = '$id' AND user_id = '$user_id'";
			$result = query($sql);

			if (row_count($result) == 1){
				$sql = "UPDATE posts SET title='$title', body='$body', cat_id='$cat_id', images='$images' WHERE id = '$id'";
				$result = query($sql);

				echo $result;

				if ($result){
					$response['status'] = 202;
					$response['message'] = "Edit Successfull";
				}
				else {
					$response['status'] = 500;
					$response['message'] = "Something went wrong";
				}

			}
			else {
				$response['status'] = 402;
				$response['message'] = "Cannot find post";
			}
		}
		echo json_encode($response);
	}
?>