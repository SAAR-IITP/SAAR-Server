<?php
    include('init.php');

    if(isset($_GET['limit']) && isset($_GET['offset'])){

        // Initialising the variables
        $response = array();
        $data = array();
        $post = array();
        $offset = $_GET['offset'];
        $limit = $_GET['limit'];

        $sql = "SELECT `id`,`user_id`, `user_name`,`user_img`, `cat_id`, `post_time`, `title`, `body`, `upvotes_ids`, `downvotes_ids`,`no_of_comment` FROM `posts` ORDER BY `post_time` DESC LIMIT $offset,$limit";
        $result = query($sql);
        if(row_count($result) == 0){
            $response['status'] = 409;
        }else{
            $response['status'] = 210;
            while($row = fetch_array($result)){
                $post['id'] = $row['id'];
                $post['user_id'] = $row['user_id'];
                $post['user_name'] = $row['user_name'];
                $post['user_img'] = $row['user_img'];
                $post['cat_id'] = $row['cat_id'];
                $post['post_time'] = format_date($row['post_time']);
                $post['title'] = stripcslashes($row['title']);
                $post['body'] = stripcslashes(substr($row['body'],0,200));
                $post['upvotes'] = count(unserialize($row['upvotes_ids']));
                $post['downvotes'] = count(unserialize($row['downvotes_ids']));
                $post['no_of_comment'] = $row['no_of_comment'];
                $data[] = $post;
            }   
            
        }
        $response['data'] = $data;
        echo json_encode($response);
    }else{
        echo "ehll";
    }
    

?>