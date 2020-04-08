<?php 
    include('init.php');
    if($_SERVER['REQUEST_METHOD']=="POST"){

        //Initializing the variables
		$messages=array();
		$response=array();

        $user_id = clean($_POST['user_id']);
        $user_name = clean($_POST['user_name']);
        $user_img = $_POST['user_img'];
        $cat_id = clean($_POST['cat_id']);
        $title = addslashes(clean($_POST['title']));
        $body = addslashes(clean($_POST['body']));
        if(isset($_POST['images']))
        $images = $_POST['images'];
        else $images = serialize(array());
        $thread_ids = serialize(array());
        $upvotes_ids = serialize(array());
        $downvotes_ids = serialize(array());

        if(empty($title)){
            $messages[] = "Title cannot be empty.";
            $response['status'] = 408;
            
        }else{
            $sql = "INSERT INTO `posts`(`user_id`, `user_name`, `user_img`, `cat_id`, `post_time`, `title`, `body`, `images`,`thread_ids`,`upvotes_ids`, `downvotes_ids`) VALUES ($user_id,'$user_name','$user_img', $cat_id, NOW(), '$title','$body','$images','$thread_ids','$upvotes_ids','$downvotes_ids')";
            $result = query($sql);
            if($result){
                $response['status'] = 209;
                $messages[] = "Posted Successfully";  
            }else{
                $response['status'] = 408;
                $messages[] = "Could not Post";
            }
            
        }
        $response['messages'] = $messages;
        echo json_encode($response);

    }
?>