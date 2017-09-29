<?php

/*
 * @Author: Chinoms Ugwuanya @ Sukulu
 * 
 */
require '../inc/config.php';

if (isset($_POST['submit'])) {
    $subj = mysqli_escape_string($conString, $_POST['subject']);
    $msg = mysqli_escape_string($conString, $_POST['msgBody']);
    $sender = mysqli_real_escape_string($conString, $_POST['userID']);
    $recipient1 = mysqli_real_escape_string($conString, $_POST['teacherOne']);
    if (isset($_POST['teacherTwo'])) {
        $recipient2 = mysqli_real_escape_string($conString, $_POST['teacherTwo']);
    }
    $firstName = mysqli_real_escape_string($conString, $_POST['fname']);
    $lastName = mysqli_real_escape_string($conString, $_POST['sname']);
    $senderName = $firstName . " " . $lastName;
    $senderName = mysqli_real_escape_string($conString, $senderName);

    if (empty($subj) || empty($msg)) {
        ?>
        <script>window.alert('One or more fields empty. Try again.'); window.history.back();</script>
        <?php

        die();
    }

    $store = "INSERT INTO messages(senderName, sender, recipient, recipientTwo, body, timestamp, subject)
         VALUES('$senderName', '$sender', '$recipient1', '$recipient2', '$msg', NOW(), '$subj')";
    if (mysqli_query($conString, $store)) {
        if ($_SERVER['HTTP_REFERRER'] = $baseURL . "newMessage.php") {
            ?>
            <script>window.alert('Message sent. Redirecting . . .');</script>
            <?php

            die(header('location:../mailbox.php'));
        } else {
            ?>
            <script> window.alert('Message sent! Redirecting . . .'); window.history.back();</script>
            <?php

        }
    } else {
        die(mysqli_error($conString));
    }
}



if (isset($_POST['sendNewsletter'])) {
    $subj = mysqli_escape_string($conString, $_POST['subject']);
    $msg = mysqli_escape_string($conString, $_POST['msg']);
    $sender = mysqli_real_escape_string($conString, $_POST['userID']);
    $firstName = mysqli_real_escape_string($conString, $_POST['fname']);
    $lastName = mysqli_real_escape_string($conString, $_POST['sname']);
    $senderName = $firstName . " " . $lastName;
    $senderName = mysqli_real_escape_string($conString, $senderName);
    if (empty($subj) || empty($msg)) {
        ?>
        <script>window.alert('One or more fields empty. Try again.'); window.history.back();</script>
        <?php

        die();
    }
    $store = "INSERT INTO newsletters(senderName, sender, body, timestamp, subj)
         VALUES('$senderName', '$sender', '$msg', NOW(), '$subj')";
    if (mysqli_query($conString, $store)) {
            ?>
            <script> window.alert('Message sent! Redirecting . . .'); window.history.back();</script>
            <?php

        } else {
            ?>
            <script>window.alert('Something went wrong. Try again, please.\n\
If this problem persists, please contact the support desk.');
            <?php
            die(mysqli_error($conString ));    
        }
    } else{
    ?>
    <script>window.alert('You came in through the wrong way. Please try again.');window.history.back();</script>
    <?php
    }

?>

