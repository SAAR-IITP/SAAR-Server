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
        $comment_id = clean($_POST['comment_id']);
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


            $sql = "SELECT `id` FROM threads WHERE post_id=$post_id and id=$comment_id";
            $result = query($sql);
            
            if (row_count($result) == 1){


            $sql = " UPDATE `threads`( `thread_body`, `thread_imgs`, `user_id`) VALUES ($post_id, '$user_name','$user_img', NOW(), '$body', '$images', $user_id, '$upvotes', '$downvotes')";
            $result = query($sql);

            


            // may be we can also store these threads as array in post
            if($result){
                $sql2 = "SELECT `no_of_comment` FROM `posts` WHERE `id`=$post_id";
                $result2 = query($sql2);


                $messages[] = "Comment  Updated";
                $response['status'] = 209;
            }else{
                $messages[] = "Could not update comment";
                $response['status'] = 408;
            }
        }

        else {
            $response['status'] = 402;
            $response['message'] = "Cannot find Comment";
        }


    }
        $response['messages'] = $messages;
        echo json_encode($response);

    }
?>