<?php 
    include('init.php');
    if($_SERVER['REQUEST_METHOD']=="POST"){

        //Initializing the variables
		$messages=array();
		$response=array();

        $user_id = clean($_POST['user_id']);
        if(isset($_POST['post_id']))
        $id = clean($_POST['post_id']);
        else if(isset($_POST['comment_id']))
        $id = $_POST['comment_id'];
        $upordown = clean($_POST['upordown']);
        $what = clean($_POST['what']);

        if(empty($user_id)){
            $messages[] = "Login to add an upvote or downvote";
            $response['status'] = 408;
            
        }else{       
            if($what == "post"){
                $select = "SELECT `upvotes_ids`, `downvotes_ids` FROM `posts` WHERE `id`=$id";
            }else if( $what == "comment"){
                $select = "SELECT `upvotes_ids`, `downvotes_ids` FROM `threads` WHERE `id`=$id";
            }else{
                $response['status'] = 408;
                $messages[] = "Something went wrong!!";
            }
                
                $result = query($select);
                if(row_count($result) == 1){
                    $row = fetch_array($result);
                    $upvotes = unserialize($row['upvotes_ids']);
                    $downvotes = unserialize($row['downvotes_ids']);
                    if($upordown == 1){
                        if(in_array($user_id,$upvotes)){
                            unset($upvotes[array_search($user_id, $upvotes)]);
                            $upvotes = array_values($upvotes);
                            $messages[] = "Removed Upvote";
                        }else{
                            array_push($upvotes,$user_id);
                            $messages[] = "Added Upvote";
                            if(in_array($user_id, $downvotes)){
                                unset($downvotes[array_search($user_id, $downvotes)]);
                                $downvotes = array_values($downvotes);
                            }
                        }    
                    }else if($upordown == -1){
                        if(in_array($user_id,$downvotes)){
                            $messages[] = "Removed downvote";
                            unset($downvotes[array_search($user_id, $downvotes)]);
                            $downvotes = array_values($downvotes);
                        }else{
                            array_push($downvotes,$user_id);
                            $messages[] = "Added downvote";
                            if(in_array($user_id, $upvotes)){
                                unset($upvotes[array_search($user_id, $upvotes)]);
                                $upvotes = array_values($upvotes);
                            }
                        }
                    }
                    $upvotes = serialize($upvotes);
                    $downvotes = serialize($downvotes);
                    if($what == "post"){
                        $sql = "UPDATE `posts` SET `upvotes_ids`='$upvotes',`downvotes_ids`='$downvotes' WHERE `id`=$id";
                    }else if( $what == "comment"){
                        $sql = "UPDATE `threads` SET `upvotes_ids`='$upvotes',`downvotes_ids`='$downvotes' WHERE `id`=$id";
                    }else{
                        $response['status'] = 408;
                        $messages[] = "Something went wrong!!";
                    }
                    $result = query($sql);
                    if(!$result){
                        $messages[] = "Query Failed";
                        $response['status'] = 408;
                    }else{
                        $response['status'] = 200;
                    }
                }else{
                    $messages[] = "Post not found";
                    $response['status'] = 408;
                }            
        }
        $response['messages'] = $messages;
        echo json_encode($response);

    }
?>