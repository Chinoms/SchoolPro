<?php

/*
 * @Author: Chinoms Ugwuanya @ Sukulu
 * 
 */

require '../inc/config.php';
$token = hash('sha256', "preci0u$");

//if (isset($_GET['subject'], $_GET['message'], $_GET['sender'])) {
if ($_REQUEST['recipientType'] === "teacher" && $_REQUEST['token'] === $token) {
    $subj = mysqli_escape_string($conString, $_REQUEST['subject']); //Passed from a GET request
    $msg = mysqli_escape_string($conString, $_REQUEST['message']); //Passed from a GET request
    $sender = mysqli_real_escape_string($conString, $_REQUEST['sender']); //Passed from a GET request
    $senderName = mysqli_real_escape_string($conString, $_REQUEST['sendername']); //to be passed from the app. Already available as long as the user in
    $recipient1 = mysqli_real_escape_string($conString, $_REQUEST['recipient']);
    $recipient2 = "NULL";

    #$firstName = mysqli_real_escape_string($conString, $_POST['fname']);
    #$lastName = mysqli_real_escape_string($conString, $_POST['sname']);
    #$senderName = $firstName . " " . $lastName;
    #$senderName = mysqli_real_escape_string($conString, $senderName);
//Form validation should be done from the android app to avoid sending empty form data.


    $store = "INSERT INTO messages(senderName, sender, recipient, recipientTwo, body, timestamp, subject)
         VALUES('$senderName', '$sender', '$recipient1', '$recipient2', '$msg', NOW(), '$subj')";
    if (mysqli_query($conString, $store)) { {
            header('Content-type: application/json');
            $result['code'] = 3080;
            $result['message'] = "Message sent!";
            echo json_encode(array($result));
            die();
        }
    } else {
        header('Content-type: application/json');
        $result['code'] = -3080;
        $result['message'] = "Message not sent";
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
    