<?php 
    include('init.php');
    if($_SERVER['REQUEST_METHOD']=="POST"){

        //Initializing the variables
		$messages=array();
		$response=array();

        $user_id = clean($_POST['user_id']);
        $cat_id = clean($_POST['cat_id']);
        $title = clean($_POST['title']);
        $body = clean($_POST['body']);
        if(isset($_POST['images']))
        $images = clean($_POST['images']);
        else $images = serialize(array());
        $thread_ids = serialize(array());
        $upvotes_ids = serialize(array());
        $downvotes_ids = serialize(array());

        if(empty($title)){
            $messages[] = "Title cannot be empty.";
            $response['status'] = 408;
            
        }else{
            $sql = "INSERT INTO `posts`(`user_id`, `cat_id`, `post_time`, `title`, `body`, `images`,`thread_ids`,`upvotes_ids`, `downvotes_ids`) VALUES ($user_id, $cat_id, NOW(), '$title','$body','$images','$thread_ids','$upvotes_ids','$downvotes_ids')";
            $result = query($sql);
            $response['status'] = 209;
            $messages[] = "Posted Successfully";  
        }
        $response['messages'] = $messages;
        echo json_encode($response);

    }
?>