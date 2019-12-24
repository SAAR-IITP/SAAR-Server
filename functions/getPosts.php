<?php
    include('init.php');

    // Initialising the variables
    $response = array();
    $data = array();

    $sql = "SELECT `id`,`user_id`, `cat_id`, `post_time`, `title`, `body`, `upvotes_ids`, `downvotes_ids` FROM `posts` WHERE 1";
    $result = query($sql);
    if(row_count($result) == 0){
        $response['status'] = 409;
    }else{
        $response['status'] = 210;
        while($row = fetch_array($result))
        $data[] = $row;
        $response['data'] = $data;
    }
    
    echo json_encode($response);

?>