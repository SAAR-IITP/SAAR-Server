<?php 
    include('init.php');
    if($_SERVER['REQUEST_METHOD']=="POST"){

        //Initializing the variables
		$messages=array();
        $response=array();

        $user_id = clean($_POST['user_id']);
        $post_id = clean($_POST['post_id']);
        $body = clean($_POST['body']);
        if(isset($_POST['images']))
        $images = clean($_POST['images']);
        else $images = serialize(array());
        if(empty($body)){
            $messages[] = "Message can not be empty.";
            $response['status'] = 408;
        }else{
            $sql = "INSERT INTO `threads`(`post_id`, `thread_time`, `thread_body`, `thread_imgs`, `user_id`) VALUES ($post_id, NOW(), '$body', '$images', $user_id)";
            $result = query($sql);
            // may be we can also store these threads as array in post
            // $sql2 = "SELECT `thread_ids` FROM `posts` WHERE `id`=$post_id";
            // $result2 = query($sql2);
            // if(row_count($result2)==1){
            //     $row = fetch_array($result2);
            //     $str_arr = $row['thread_ids'];
            //     $arr_var = unserialize($str_arr);
            //     $arr_var += array($thread_id);
            //     $final_str = serialize($arr_var);
            //     $sql3 = "UPDATE `posts` SET `thread_ids`='$final_str' WHERE `id`=$post_id";
            //     $result3 = query($sql3);
            // }
            if($result){
                $messages[] = "Message sent";
                $response['status'] = 209;
            }else{
                $messages[] = "Message could not be sent";
                $response['status'] = 408;
            }
        }
        $response['messages'] = $messages;
        echo json_encode($response);

    }
?>