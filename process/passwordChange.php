<?php

session_start(); // Starting Session
require '../inc/config.php';
$error = ''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['passOne']) || empty($_POST['passTwo'])) {
      
       ?>
<script> window.alert('One or more fields empty.'); window.history.back(); </script>
<?php
       die(); 
    } else {

        $passOne = hash('sha256', $_POST['passOne']);
        $passTwo = hash('sha256', $_POST['passTwo']);
        if($passOne !== $passTwo){
            ?>
<script>window.alert('Passwords don\'t match.'); window.history.back();</script>
<?php
die();
        }
      $password = $passTwo;
        $userID = $_POST['userID'];
// SQL query to fetch information of registerd users and find user match.
        $query = mysqli_query($conString, "UPDATE users SET pword = '$password' WHERE phonenum = '$userID'");
        $rows = mysqli_affected_rows($conString);
        if ($rows == 1) {
          ?>
<script>window.alert('Password Changed Successfully'); window.histroy.back();</script>
<?php
        } else {
          
        die(mysqli_error($conString));
        }
        mysqli_close($conString); // Closing Connection
    }
}
else{
   ?>
<script>window.alert('You didn\'t come through the right way. Please try again.'); window.history.back();</script>
<?php
    die();
}
?>