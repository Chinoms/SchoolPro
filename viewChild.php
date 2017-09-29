<?php

include_once '../inc/config.php';

    /* require the user as the parameter */
    $token = "preci0u$";
    $token = hash('sha256', $token);
    #$password = hash('sha256', $_GET['pword']);
    $userID = $_REQUEST['userID'];

    $checkToken = $_REQUEST['token'];
    if ($checkToken == $token) {

        $format = 'json' ? 'json' : 'json'; //xml is the default


	
        $getUserInfo = mysqli_query($conString, "SELECT *, x.grade, (select fees from grade where grade = x.grade ) as feesAmount  FROM students x WHERE parentID = '$userID'");

        /* create one master array of the records */
        $posts = array();
        if (mysqli_affected_rows($conString) > 0) {
            while ($post = mysqli_fetch_assoc($getUserInfo)) {
                $posts[] = array('userinfo' => $post);
            }

            header('Content-type: application/json');
            if (!empty($posts)) {
                $result['code'] = 200;
                $result['message'] = "OK: Login Successful!";
                echo json_encode(array('posts' => $posts, $result));
            }
        } else {
            header('Content-type: application/json');
            $result['code'] = 401;
            $result['message'] = "Access denied. Authentication failed.";
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