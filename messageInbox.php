<?php

require '../inc/config.php';
$token = hash('sha256', "preci0u$");

if ($_REQUEST['token'] == $token) {
    if (isset($_REQUEST['userID'])) {
        $userID = $_REQUEST['userID'];
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];

        $checkMessage = "SELECT id, subject, recipient, sender, sendername FROM messages WHERE recipient = '$userID' ORDER BY id DESC LIMIT  $start, $end";
        $messageQuery = mysqli_query($conString, $checkMessage) or die(mysqli_error($conString));
        while($messageArray = mysqli_fetch_assoc($messageQuery)){
            $posts[]=array('info'=>$messageArray);
        }
        header('content-type: application/json');
        //$messageInfo[] = array('userinfo' => $messageArray);
        if(!empty($posts)){
        $result['code'] = 3080;
            $result['message'] = "Data fetched successfuly!";    
        echo json_encode(array($posts, $result));
        }else {
        mysqli_error();
            $result['code'] = -3080;
            $result['message'] = "Not set!";
            echo json_encode(array($result));
            die();
        }
    } else {
        //header('Content-type: application/json');
        $result['code'] = -3080;
        $result['message'] = "No data received.!";
        echo json_encode(array($result));
        die();
    }
} else {
    //header('Content-type: application/json');
    $result['code'] = -3080;
    $result['message'] = "Invalid token!";
    echo json_encode(array($result));
    die();
}
?>