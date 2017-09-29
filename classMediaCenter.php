<?php

include_once '../inc/config.php';

    /* require the user as the parameter */
    $token = "preci0u$";
    $token = hash('sha256', $token);
    #$password = hash('sha256', $_GET['pword']);
    $recipient = $_REQUEST['recipient'];
    $grade = $_REQUEST['grade'];
    $checkToken = $_REQUEST['token'];
    $start = $_REQUEST['start'];
    $end = $_REQUEST['end'];
    if ($checkToken == $token) {
        
      $getCards = mysqli_query($conString, "SELECT * FROM classdownloads WHERE recipient = '$recipient' AND recipient = '$grade'  ORDER BY id LIMIT $start, $end");
          
        
           $posts = array();
        if (mysqli_affected_rows($conString) > 0) {
            while ($post = mysqli_fetch_assoc($getCards)) {
                $posts[] = array('userinfo' => $post);
            }
 
            header('Content-type: application/json');
            if (!empty($posts)) {
                $result['code'] = 200;
                $result['message'] = "OK: Data available.";
                echo json_encode(array('posts' => $posts, $result));
            }
        } else {
            header('Content-type: application/json');
            $result['code'] = 401;
            $result['message'] = "Empty result set.";
            echo json_encode(array($result));
            die();
        }
        

    
    } else {
        header('Content-type: application/json');
        $result['code'] = -3080;
        $result['message'] = "Invalid token!";
        echo json_encode(array($result));
        die();
    }

?>