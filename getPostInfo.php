<?php 
    include('init.php');

    // Inititalization of array
    $response = array();
    $post_data = array();
    $replies = array();
    $inst = array();

    if(!isset($_GET['post_id'])){
        $response['status'] = 409;
        $response['message'] = "Could not get post ID";
    }else{
        $post_ID = clean($_GET['post_id']);
        $sql = "SELECT `id`, `user_id`, `cat_id`, `post_time`, `title`, `body`, `images`, `thread_ids`, `upvotes_ids`, `downvotes_ids` FROM `posts` WHERE `id`=$post_ID";
        $result = query($sql);
        if(row_count($result) == 0){
            $response['status'] = 409;
            $response['message'] = "Post Not Found!!";
        }else{

            $row = fetch_array($result);
            $post_data['title'] = $row['title'];
            $post_data['body'] = $row['body'];
            $post_data['post_time'] = format_date($row['post_time']);
            $post_data['images'] = $row['images'];
            $post_data['post_id'] = $row['id'];
            $post_data['user_id'] = $row['user_id'];
            $post_data['cat_id'] = $row['cat_id'];
            $post_data['upvotes'] = count(unserialize($row['upvotes_ids']));
            $post_data['downvotes'] = count(unserialize($row['downvotes_ids']));

            $sql = "SELECT `thread_time`, `thread_body`, `thread_imgs`, `thread_upvotes`, `thread_downvotes`, `user_id` FROM `threads` WHERE `post_id`=$post_ID";
            $result = query($sql);
            while($row = fetch_array($result)){
                $inst['time'] = format_date($row['thread_time']);
                $inst['body'] = $row['thread_body'];
                $inst['images'] = $row['thread_imgs'];
                $inst['user_id'] = $row['user_id'];
                $inst['upvotes'] = count(unserialize($row['thread_upvotes']));
                $inst['downvotes'] = count(unserialize($row['thread_downvotes']));
                $replies[] = $inst;
            }
            $response['data'] = $post_data;
            $response['replies'] = $replies;
            $response['status'] = 210;
            $response['message'] = "Sucess";
        }
    }
    echo json_encode($response);
?>