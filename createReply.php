<?php 
    include('init.php');
    if($_SERVER['REQUEST_METHOD']=="POST"){

        //Initializing the variables
		$messages=array();
        $response=array();

        $user_id = clean($_POST['user_id']);
        $user_name = clean($_POST['user_name']);
        $user_img = $_POST['user_img'];
        $post_id = clean($_POST['post_id']);
        $body = clean($_POST['body']);
        if(isset($_POST['images']))
        $images = clean($_POST['images']);
        else $images = serialize(array());
        $upvotes = serialize(array());
        $downvotes = serialize(array());
        if(empty($body)){
            $messages[] = "Message can not be empty.";
            $response['status'] = 408;
        }else{
            $sql = "INSERT INTO `threads`(`post_id`,`user_name`,`user_img`, `thread_time`, `thread_body`, `thread_imgs`, `user_id`,`upvotes_ids`,`downvotes_ids`) VALUES ($post_id, '$user_name','$user_img', NOW(), '$body', '$images', $user_id, '$upvotes', '$downvotes')";
            $result = query($sql);
            // may be we can also store these threads as array in post
            if($result){
                $sql2 = "SELECT `no_of_comment` FROM `posts` WHERE `id`=$post_id";
                $result2 = query($sql2);
                if(row_count($result2)==1){
                    $row = fetch_array($result2);
                    $initial = $row['no_of_comment'];
                    $final = $initial + 1;
                    $sql3 = "UPDATE `posts` SET `no_of_comment`=$final WHERE `id`=$post_id";
                    $result3 = query($sql3);
                }
                $messages[] = "Comment Posted";
                $response['status'] = 209;
            }else{
                $messages[] = "Could not post comment";
                $response['status'] = 408;
            }
        }
        $response['messages'] = $messages;
        echo json_encode($response);

    }
?>